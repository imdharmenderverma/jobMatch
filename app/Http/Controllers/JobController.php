<?php

namespace App\Http\Controllers;

use App\Exports\ExportJob;
use App\Helpers\CommonHelper;
use App\Helpers\NotificationHelper;
use App\Http\Requests\StoreJobRequest;
use App\Http\Traits\CalculateUserMatchingJob;
use App\Http\Traits\ImageUploadTrait;
use App\Interfaces\AppUserRepositoryInterface;
use App\Interfaces\JobApplyRepositoryInterface;
use App\Interfaces\JobRepositoryInterface;
use App\Interfaces\SkillRepositoryInterface;
use App\Mail\UpdateApplyJobStatusMail;
use DataTables;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    use ImageUploadTrait, CalculateUserMatchingJob;

    protected $jobRepository = "";
    protected $skillRepository = "";
    protected $applyJobRepository = "";
    protected $appUserRepository = "";
    public function __construct(JobRepositoryInterface $jobRepository, SkillRepositoryInterface $skillRepository, JobApplyRepositoryInterface $applyJobRepository, AppUserRepositoryInterface $appUserRepository)
    {
        $this->jobRepository = $jobRepository;
        $this->skillRepository = $skillRepository;
        $this->applyJobRepository = $applyJobRepository;
        $this->appUserRepository = $appUserRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $searchAllData = $this->jobRepository->get($request->search, $request->location, $request->sort_by);

            foreach ($searchAllData as $k => $v) {
                $appUsers = [];
                foreach ($v->applyUser as $value) {
                    $value['appUser']['percentage'] = asset('assets/img/percentage.png');
                    $value['appUser']['profile_photo_path'] = $this->getImageUrl($value['appUser']['profile_photo_path']);
                    $appUsers[] = $value['appUser'];
                }
                $searchAllData[$k]->apply_user = $appUsers;
                $matchUsers = [];
                foreach ($v->matchUser as $value) {
                    if (isset($value['appUser']['profile_photo_path'])) {
                        $value['appUser']['percentage'] = asset('assets/img/percentage.png');
                        $value['appUser']['profile_photo_path'] = $this->getImageUrl($value['appUser']['profile_photo_path']);
                        $matchUsers[] = $value['appUser'];
                    }
                }
                $searchAllData[$k]->match_user = $matchUsers;
            }

            return Datatables::of($searchAllData)
                ->addColumn('status', function ($row) {
                    $checked = $row->status == 1 || $row->status == 2 ? 'checked' : '';
                    return '<label class="switch">
                        <input type="checkbox" class="job-status" ' . $checked . ' data-id="' . $row->id . '" data-val="' . $row->status . '">
                        <span class="slider round"></span>
                    </label>';
                })
                ->addColumn('view', function ($row) {
                    $view = '<a data-id="' . $row->id . '" data-title="' . $row->title . '" class="viewJobs">View Job</a>';
                    return $view;
                })
                ->addColumn('applicant', function ($row) {
                    return $row->apply_user_count;
                })
                ->addColumn('match', function ($row) {
                    return $row->match_user_count;
                })
                ->addColumn('location', function ($row) {
                    return $row->location;
                })
                ->addColumn('created_at', function ($row) {
                    return CommonHelper::dateFormate($row->created_at, 'd-m-Y');
                })
                ->addColumn('type_of_work_name', function ($row) {
                    return CommonHelper::jobWorkTypeText($row->type_of_work);
                })
                ->addColumn('action', function ($row) {
                    $btn = '<img src="' . asset('assets/img/editjob.png') . '" data-id="' . $row->id . '" data-title="' . $row->title . '" class="jobDelete edit-job action-icon">';
                    $btn .= '<img src="' . asset('assets/img/deletejob.png') . '" data-id="' . $row->id . '" class="jobDelete delete-job action-icon">';
                    return $btn;
                })

                ->rawColumns(['action', 'status', 'view', 'type_of_work_name', 'applicant', 'match', 'created_at'])
                ->make(true);
        }
        return view('recruiter.job.index');
    }


    public function export(Request $request)
    {
        $search = isset($request->s) ? $request->s : '';
        $data = $this->jobRepository->get($search)->get();
        foreach ($data as $key => $value) {
            $data[$key]['type_of_work_name'] = CommonHelper::jobWorkTypeText($value['type_of_work']);
            $data[$key]['industry_name'] = $value['industries']['title'] ?? '';
            $data[$key]['start_date'] = CommonHelper::dateFormate($value['start_date'], 'd-m-Y');
            $data[$key]['end_date'] = CommonHelper::dateFormate($value['end_date'], 'd-m-Y');
            $skills = '';
            foreach ($value['skill'] as $v) {
                $skills .= $v['title'] . ', ';
            }
            $data[$key]['skill_name'] = rtrim($skills, ', ');
        }
        return Excel::download(new ExportJob($data), 'jobs.xlsx');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $addJobDetails = $this->jobRepository->store($request->all());

        $this->saveJobMatch($addJobDetails->id);
        try {
            $sendMailJobDetails = [
                'job_name' => $request->role_name,
                'business_name' => auth()->user()->business_name
            ];
            Mail::to(auth()->user()->email)->send(new \App\Mail\CreateJob($sendMailJobDetails));
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], trans(
                'messages.custom.error_messages'
            ), $this->failedStatus);
        }

        return $this->sendResponse(true, $addJobDetails, trans(
            'messages.custom.create_messages',
            ["attribute" => "Job"]
        ), $this->successStatus);
    }

    public function edit($id)
    {
        $data = $this->jobRepository->getJobQuestionById($id)->toArray();
        $data['image_url'] = $this->getImageUrl($data['image'], 'jobs');
        $data['skill_id'] = explode(',', $data['skill_id']);
        $data['start_date_format'] = CommonHelper::dateFormate($data['start_date'], 'd/m/Y');
        $data['end_date_format'] = CommonHelper::dateFormate($data['end_date'], 'd/m/Y');
        $data['post_date_format'] = CommonHelper::dateFormate($data['created_at'], 'd/m/Y');
        $data['type_of_work_text'] = CommonHelper::jobWorkTypeText($data['type_of_work']);
        $appUsers = [];
        foreach ($data['apply_user'] as $value) {
            if ($value['app_user'] != null) {
                $value['app_user']['percentage'] = asset('assets/img/percentage.png');
                $value['app_user']['profile_photo_path'] = $this->getImageUrl($value['app_user']['profile_photo_path']);
                $appUsers[] = $value['app_user'];
            }
        }
        $data['apply_user'] = $appUsers;
        $matchUsers = [];

        foreach ($data['match_user'] as $k => $value) {
            if ($value['app_user'] != null) {
                $value['app_user']['percentage'] = asset('assets/img/percentage.png');
                $value['app_user']['profile_photo_path'] = $this->getImageUrl($value['app_user']['profile_photo_path']);
                $matchUsers[] = $value['app_user'];
            }
        }
        $data['match_user'] = $matchUsers;

        $skills = $this->skillRepository->getSkillIndustry($data['industry']);
        $options = [];
        foreach ($skills as $key => $value) {
            $selected = in_array($value->id, $data['skill_id']) ? 'selected' : '';
            $options[$key] = '<option ' . $selected . ' value="' . $value->id . '">' . $value->title . '</option>';
        }
        $data['skills'] = $options;
        return $this->sendResponse(true, $data, '', $this->successStatus);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreJobRequest $request, $id)
    {
        try {
            $isExists = $this->jobRepository->getDataByColumn('id', $id);
            if ($isExists) {
                $data = $this->jobRepository->update($id, $request->all());

                $calculateJobMatch = $this->saveJobMatch($id);

                return $this->sendResponse(true, $data, trans(
                    'messages.custom.update_messages',
                    ["attribute" => "Job"]
                ), $this->successStatus);
            } else {
                return $this->sendResponse(false, [], trans('validation.no_data_found_error'), $this->failedStatus);
            }
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], trans(
                'messages.custom.error_messages'
            ), $this->failedStatus);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $this->jobRepository->delete($id);
            return $this->sendResponse(true, ['data' => []], trans(
                'messages.custom.delete_messages',
                ["attribute" => "Job"]
            ), $this->successStatus);
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], trans(
                'messages.custom.error_messages'
            ), $this->errorStatus);
        }
    }

    public function updateStatus(Request $request)
    {
        try {
            $isExistsId = $this->jobRepository->getDataByColumn('id', $request->id);
            if ($isExistsId) {
                $data = $this->jobRepository->update($isExistsId->id, ['status' => $request->status]);
                return $this->sendResponse(true, $data, trans(
                    'messages.custom.update_messages',
                    ["attribute" => "Job status"]
                ), $this->successStatus);
            } else {
                return $this->sendResponse(false, [], trans('validation.no_data_found_error'), $this->failedStatus);
            }
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], trans(
                'messages.custom.error_messages'
            ), $this->failedStatus);
        }
    }

    public function updateJobApplyStatus(Request $request)
    {
        try {
            $job = $this->jobRepository->getDataByColumn('id', $request->job_id);
            if ($job) {
                $status = $request->status == 1 ? 1 : 2;
                $update = $this->applyJobRepository->update($request->job_id, $request->app_user_id, ['status' => $status]);
                $appUser = $this->appUserRepository->getSingalUserData('id', $request->app_user_id);


                $subject = $status == 1 ? 'Your application for ' . $job->role_name . ' has been selected ' : 'Job Ap
                plication Rejected by ' . $job->company_name . ' ';
                // Notificationif()
                if ($status == 1) {
                    $notification['message'] = "Your application for " . $job->role_name . " has been selected ";

                    $notification['title'] = " ";
                    $notification['job_id'] = $job->id;
                    $markAsTrue = false;
                    NotificationHelper::sendNotification($markAsTrue, $notification, $appUser->id, $request->job_id, true);
                    // End Notification
                    //recruter user  Mail

                    $data = [
                        'first_name' => $appUser->first_name,
                        'subject' => $subject,
                        'company_name' => $job->company_name,
                        'role_name' => $job->role_name,
                        'job_name' => $job->role_name,
                        'status' => $status,
                    ];

                    Mail::to($appUser->email)->send(new UpdateApplyJobStatusMail($data));
                }

                //recruter email
                try {
                    $details = [
                        'job_name' => $job->role_name,
                        'userName' => $job->recruiter->business_name,
                        'applicant_name' => $appUser->first_name . " " . $appUser->last_name
                    ];
                    Mail::to($job->recruiter->email)->send(new \App\Mail\RecruiterUserMail($details));
                } catch (\Exception $e) {
                    return $this->sendResponse(false, [], trans(
                        'messages.custom.error_messages'
                    ), $this->failedStatus);
                }
                //Position filled up mail
                $postionFillUp = $this->applyJobRepository->getByJobId($request->job_id);
                try {
                    if (isset($postionFillUp)) {
                        foreach ($postionFillUp as $value) {

                            if ($request->app_user_id != $value->app_user_id) {
                                $applyUser =  $this->applyJobRepository->applyUserDetails($value->app_user_id);
                                if (isset($applyUser) && $applyUser != NULL) {


                                    $details = [
                                        'job_name' => $job->role_name,
                                        'userName' => $applyUser->first_name,
                                    ];
                                    $notification['message'] = "Position for job "  . $job->role_name .  " has been filled up ";
                                    $notification['title'] = 'job match Position for job';

                                    $notification['job_id'] = $request->job_id;
                                    $markAsTrue = false;
                                    Mail::to($applyUser->email)->send(new \App\Mail\PositionFilledupMail($details));
                                    NotificationHelper::sendNotification($markAsTrue, $notification, $value->app_user_id, $request->job_id, true);
                                }
                            }
                        }
                    }
                } catch (\Exception $e) {
                    return $this->sendResponse(false, [], trans(
                        'messages.custom.error_messages'
                    ), $this->failedStatus);
                }


                $trans = $status == 1 ? 'messages.custom.accept_job' : 'messages.custom.reject_job';
                return $this->sendResponse(true, $status, trans($trans), $this->successStatus);
            } else {
                return $this->sendResponse(false, [], trans('validation.no_data_found_error'), $this->failedStatus);
            }
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], trans(
                'messages.custom.error_messages'
            ), $this->failedStatus);
        }
    }

    public function saveJobFulfill(Request $request)
    {


        if ($request->step == "2") {
            $isExistsId = $this->jobRepository->getDataByColumn('id', $request->job_id);
            $jobApplayAllUser = $this->jobRepository->jobApplayAllUser($request->job_id);


            if ($isExistsId) {

                if (!empty($request->app_user_id)) {
                    foreach ($request->app_user_id as $value) {
                        $this->jobRepository->saveJobFulfill(['status' => 1, 'job_id' => $request->job_id, 'app_user_id' => $value]);
                    }
                } else {
                    if ($request->status != 1) {
                        $this->jobRepository->saveJobFulfill(['status' => $request->status, 'job_id' => $request->job_id]);
                    }
                }
                $this->jobRepository->update($isExistsId->id, ['status' => 2]);



                if (isset($jobApplayAllUser)) {
                    foreach ($jobApplayAllUser as $jobApplayUser) {
                        if ($jobApplayUser->appUser != null) {
                            $details = [
                                'job_name' => $isExistsId->role_name,
                                'userName' => $jobApplayUser->appUser->first_name
                            ];
                            Mail::to($jobApplayUser->appUser->email)->send(new \App\Mail\RecruiterUserCompleteJob($details));
                        }
                    }
                }
                $details = [
                    'job_name' => $isExistsId->role_name,
                    'business_name' =>
                    $isExistsId->role_name,
                ];
                Mail::to(auth()->user()->email)->send(new \App\Mail\RecruiterCompleteJob($details));
                $notification['message'] = "Your job  " .   $isExistsId->role_name . " marked as completed";
                $notification['title'] = 'job match Application submitted ';
                $notification['job_id'] = $request->job_id;
                $markAsTrue = true;
                NotificationHelper::sendNotification($markAsTrue, $notification, $request->app_user_id[0], $request->job_id, true);

                $matchUsers = $this->jobRepository->getJobByMatchUsers($request->job_id);
                $users = [];
                foreach ($matchUsers as $value) {
                    if (isset($value['appUser']['id'])) {
                        $data = [
                            'id' => $value['appUser']['id'],
                            'name' => $value['appUser']['first_name'] . ' ' . $value['appUser']['last_name'],
                            'profile_photo_path' => $this->getImageUrl($value['appUser']['profile_photo_path'])
                        ];
                        $users[] = $data;
                    }
                }
                return $this->sendResponse(true, $users, trans(
                    'messages.custom.update_messages',
                    ["attribute" => "Job Status"]
                ), $this->successStatus);
            } else {
                return $this->sendResponse(false, [], trans('validation.no_data_found_error'), $this->failedStatus);
            }
        } else {
            $matchUsers = $this->jobRepository->getJobByMatchUsers($request->job_id);


            $users = [];
            foreach ($matchUsers as $value) {
                if (isset($value['appUser']['id'])) {
                    $data = [
                        'id' => $value['appUser']['id'],
                        'name' => $value['appUser']['first_name'] . ' ' . $value['appUser']['last_name'],
                        'profile_photo_path' => $this->getImageUrl($value['appUser']['profile_photo_path'])
                    ];
                    $users[] = $data;
                }
            }
            return $this->sendResponse(true, $users, trans(
                'messages.custom.update_messages',
                ["attribute" => "Job Status"]
            ), $this->successStatus);
        }
    }

    public function viewResume(Request $request)
    {
        $resumeShowData  = $this->jobRepository->getResume($request->all());
        foreach ($resumeShowData as $key => $value) {
            $resumeShowData[$key]->file = $this->getImageUrl($value->file);
        }
        return view('layouts.resume', compact('resumeShowData'));
    }

    public function viewCoverLetter(Request $request)
    {
        $coverLetterShowData  = $this->jobRepository->getCoverLetter($request->all());
        foreach ($coverLetterShowData as $key => $value) {
            $coverLetterShowData[$key]->file = $this->getImageUrl($value->file);
        }
        return view('layouts.cover-letter.cover-letter', compact('coverLetterShowData'));
    }

    public function viewPortfolio(Request $request)
    {
        $experienceShowData  = $this->jobRepository->getPortfolio($request->all());
        return view('layouts.portfolio.portfolio', compact('experienceShowData'));
    }

    public function viewVideo(Request $request)
    {
        $videoShowData  = $this->jobRepository->getVideo($request->all());
        $videoShowData->video = $videoShowData->video != null ? $this->getImageUrl($videoShowData->video) : null;
        return view('layouts.video-data.video', compact('videoShowData'));
    }
}
