<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelper;
use App\Http\Traits\ImageUploadTrait;
use App\Interfaces\AppUserRepositoryInterface;
use App\Interfaces\IndustryRepositoryInterface;
use App\Interfaces\JobRepositoryInterface;
use Illuminate\Http\Request;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class AppUserController extends Controller
{
    use ImageUploadTrait;

    protected $jobRepository = "";
    protected $appUserRepository = "";
    protected $industryRepository = "";
    public function __construct(JobRepositoryInterface $jobRepository, AppUserRepositoryInterface $appUserRepository, IndustryRepositoryInterface $industryRepository)
    {
        $this->jobRepository = $jobRepository;
        $this->appUserRepository = $appUserRepository;
        $this->industryRepository = $industryRepository;
    }

    public function edit($id)
    {
        $exploadId = explode(',', $id);
        $userId = $exploadId[0];
        $jobId = $exploadId[1];
        $app = $exploadId[2];
        if ($app == 1) {
            $data = $this->jobRepository->getJobByAppUserId($userId, $jobId)->toArray();
        } else {
            $data = $this->jobRepository->getJobByMatchUserId($userId, $jobId)->toArray();
        }

        $data['app_user']['profile_photo_path'] = $this->getImageUrl($data['app_user']['profile_photo_path'], 'app_users');
        $data['app_user']['dob'] = CommonHelper::dateFormate($data['app_user']['dob'], 'd/m/Y');
        $data['job']['start_date_format'] = CommonHelper::dateFormate($data['job']['start_date'], 'd/m/Y');
        $data['job']['end_date_format'] = CommonHelper::dateFormate($data['job']['end_date'], 'd/m/Y');
        $data['job']['post_date_format'] = CommonHelper::dateFormate($data['job']['created_at'], 'd/m/Y');
        $data['job']['type_of_work_text'] = CommonHelper::jobWorkTypeText($data['job']['type_of_work']);
        return $this->sendResponse(true, $data, '', $this->successStatus);
    }

    public function getProfile(Request $request)
    {
        $data = $this->jobRepository->getAppUserById($request->user_id)->toArray();
        $data['profile_photo_path'] = $this->getImageUrl($data['profile_photo_path'], 'app_users');
        $data['dob'] = CommonHelper::dateFormate($data['dob'], 'd/m/Y');
        return $this->sendResponse(true, $data, '', $this->successStatus);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->appUserRepository->get($request->search, ['industry' => $request->industry, 'sort_by' => $request->sort_by], $request->location);

            return Datatables::of($data)
                ->addColumn('id', function () {
                    static  $id = 0;
                    return ++$id;
                })->addColumn('age', function ($row) {
                    return Carbon::parse($row->dob)->age;
                })->addColumn('gender', function ($row) {
                    $gender = 'Other';
                    if ($row->gender == 1) {
                        $gender = 'Male';
                    } else if ($row->gender == 2) {
                        $gender = 'Female';
                    }
                    return $gender ?? '-';
                })->addColumn('name', function ($row) {
                    $image = Storage::disk('public')->url($row->profile_photo_path);
                    if (empty($image)) {
                        $image = '../assets/img/user.jpg';
                    }
                    $name = '<a href="javascript:void(0)" data-id="' . $row->id . '" data-app="0" class="applicantUserViewDetails user-list-a"><div class="user-name-new">
                    <img src="' . $image . '" alt="" width="35" height="35" class="popupCompleteImg">
                    <span>' . $row->first_name . ' ' . $row->last_name . '</span>
                    </div></a>';
                    return $name ?? '-';
                })->addColumn('industry_name', function ($row) {
                    return $row->industries != null ? $row->industries->title : '-';
                })->addColumn('job_match_count', function ($row) {
                    return $row->match_user_count ?? '-';
                })->addColumn('location', function ($row) {
                    return  $row->address_state ?? '-';
                })
                ->addColumn('status', function ($row) {
                    $checked = $row->status == 1 ? 'checked' : '';
                    return '<label class="switch">
                        <input type="checkbox" class="user-status" ' . $checked . ' data-id="' . $row->id . '" data-val="' . $row->status . '">
                        <span class="slider round"></span>
                    </label>';
                })->addColumn('action', function ($row) {
                    $btn = '<div class="dropdown">
                    <button class="dropbtn action-btn-icon" data-id="' . $row->id . '" style="    width: 20px;
                    background-image: url(../assets/img/dots.svg);
                    height: 20px;
                    background-size: 20px;">
                </button>
                    <div id="myDropdown' . $row->id . '" class="dropdown-content myDropdown edit-dlt-drop">
                        <a href="javascript:void(0)" data-id="' . $row->id . '" class="delete-user" style="text-align: left;"><img src="' . asset('assets/img/deletejob.png') . '" alt="" width="15">Delete</a>
                    </div>
                </div>';
                    return $btn;
                })
                ->rawColumns(['id', 'action', 'status', 'location', 'name', 'age', 'industry_name', 'job_match_count'])
                ->make(true);
        }
        $industries = $this->industryRepository->get();
        return view('admin.app_user.index', compact('industries'));
    }

    public function destroy($id)
    {
        try {
            $this->appUserRepository->delete($id);
            return $this->sendResponse(true, ['data' => []], trans(
                'messages.custom.delete_messages',
                ["attribute" => "User"]
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
            $isExists = $this->appUserRepository->getDataById('id', $request->id);
            if ($isExists) {
                $data = $this->appUserRepository->updateUserWithId($isExists->id, ['status' => $request->status]);
                $message = ($request->status == 1) ? trans('messages.custom.blocked_message') : trans('messages.custom.unblocked_message');
               
                return $this->sendResponse(true, $isExists, $message
                , $this->successStatus);
            } else {
                return $this->sendResponse(false, [], trans('validation.no_data_found_error'), $this->failedStatus);
            }
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], trans(
                'messages.custom.error_messages'
            ), $this->failedStatus);
        }
    }
}
