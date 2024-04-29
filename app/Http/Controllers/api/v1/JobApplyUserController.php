<?php

namespace App\Http\Controllers\api\v1;

use App\Helpers\NotificationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\JobApplyApiRequest;
use App\Interfaces\JobApplyRepositoryInterface;
use App\Interfaces\JobRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class JobApplyUserController extends Controller
{
    protected $applyJobRepository = "";
    protected $jobRepository = "";
    public function __construct(JobApplyRepositoryInterface $applyJobRepository, JobRepositoryInterface $jobRepository)
    {
        $this->applyJobRepository = $applyJobRepository;
        $this->jobRepository = $jobRepository;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobApplyApiRequest $request)
    {
        try {
            $job = $this->jobRepository->getDataByColumn('id', $request->job_id);
            if ($job) {
                $alreadyAppliedJob = $this->applyJobRepository->checkAlreadyJob($request->job_id);
                if ($alreadyAppliedJob) {
                    return $this->sendResponse(false, [], trans(
                        'messages.custom.already_applied_job'
                    ), $this->failedStatus);
                }
                $reqData = $request->all();
                $reqData['created_by'] = $job->user_id;
                $reqData['job_id'] = $job->id;

                $data = $this->applyJobRepository->store($reqData);
                $answer = $this->applyJobRepository->storeJobAnswer(json_decode($reqData['job_answer'], true));
                // Notification
                $notification['message'] = "Application submitted for job " . $job->role_name .  ".";
                $notification['title'] = "Job Applied Notification";
                $notification['notification_type'] = config('global.notification.apply_job');
                $notification['job_id'] = $job->id;
                $markAsTrue = false;
                NotificationHelper::sendNotification($markAsTrue, $notification, Auth::user()->id, $request->job_id, true);

                try {
                    $details = [
                        'job_name' => $job->role_name,
                        'user_name' => auth()->user()->first_name . ' ' . auth()->user()->last_name,
                        'business_name' => $job->recruiter->business_name
                    ];
                    Mail::to(auth()->user()->email)->send(new \App\Mail\UserApplyJob($details));
                    Mail::to($job->recruiter->email)->send(new \App\Mail\RecruiterRecivedApplication($details));
                } catch (\Exception $e) {
                    return $this->sendResponse(false, [], trans(
                        'messages.custom.error_messages'
                    ), $this->failedStatus);
                }
                return $this->sendResponse(true, [$data], trans(
                    'messages.custom.messages',
                    ["attribute" => "Job Apply"]
                ), $this->successStatus);
            } else {
                return $this->sendResponse(false, [], trans(
                    'messages.custom.invalid',
                    ['attribute' => 'Job']
                ), $this->failedStatus);
            }
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], $e->getMessage(), $this->failedStatus);
        }
    }
}
