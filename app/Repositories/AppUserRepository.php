<?php

namespace App\Repositories;

use App\Helpers\CommonHelper;
use App\Helpers\FileUploadHelper;
use App\Http\Traits\ImageUploadTrait;
use App\Interfaces\AppUserRepositoryInterface;
use App\Models\AppUser;
use App\Models\Notification;
use App\Models\ResumeBuilder;
use App\Models\ResumeBuilderSubscription;
use App\Models\UserPreviousExperience;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AppUserRepository implements AppUserRepositoryInterface
{
    const ACTIVE_STATUS = 1;
    const INACTIVE_STATUS = 0;

    use ImageUploadTrait;

    public function updateUserWithId($id, $data)
    {
        if (isset($data['profile_photo_path']) && $data['profile_photo_path'] != null) {
            $data['profile_photo_path'] = $this->storeImage($data['profile_photo_path'], 'app_users');
        }
        AppUser::find($id)->update($data);
        return AppUser::find($id);
    }

    public function savePreviousExperience($id, $data)
    {
        if ($data['tick_box'] == '0') {
            $saveData = $data;
        } else {
            $saveData = [
                'tick_box' => 1
            ];
        }
        $saveData['user_id'] = $id;
        return UserPreviousExperience::create($saveData);
    }

    public function updatePreviousExperience($updateId, $data)
    {
        UserPreviousExperience::where('id', $updateId)->update($data);
        return UserPreviousExperience::where('id', $updateId)->first();
    }


    public function deletePreviousExperience($id)
    {
        return UserPreviousExperience::find($id)->delete();
    }

    public function getPreviousExperienceById($id)
    {
        return UserPreviousExperience::find($id);
    }

    public function store($request)
    {
        $user = AppUser::create($request);
        return $user;
    }

    public function delete($id)
    {
        return AppUser::where('id', $id)->delete();
    }

    public function get($search = '', $filter = [], $location = '')
    {
        $query = AppUser::with('industries')->withCount(['jobMatch', 'matchUser']);
        if ($location != '') {
            $array = explode(" ", $location);
            $query = $query->where(function ($q) use ($array) {
                foreach ($array as $searchLocation) {
                    $q->orWhere('location', 'like', "%{$searchLocation}%");
                }
            });
        }

        if ($search != '') {
            $query = $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhere('gender', 'like', "%{$search}%")
                    ->orWhereHas('industries', function ($q) use ($search) {
                        $q->where('title', 'like', "%{$search}%");
                    });
            });
        }
        if (count($filter) > 0) {
            if (isset($filter['industry']) && $filter['industry'] !== null) {
                $query = $query->whereHas('industries', function ($q) use ($filter) {
                    $q->where('id', $filter['industry']);
                });
            }

            if (isset($filter['sort_by']) && $filter['sort_by'] == 1) {
                $query = $query->orderBy('first_name', 'asc')->orderBy('last_name', 'asc');
            } else {
                $query = $query->orderBy('id', 'desc');
            }
        }
        return $query->get();
    }


    public function login($request)
    {
        $response = ['status' => false, 'data' => []];
        $query = AppUser::where('email',$request->email)->first();
        if(isset($query->id)){
            if($query->status ==1){
                $response['msg'] = trans('messages.custom.user_blocked_message');
            }else{
                if (Auth::guard('app_user')->attempt(['email' => $request->email, 'password' => $request->password])) {
                    $user = Auth::guard('app_user')->user();
                    $user['access_token'] = $user->createToken('MyAuthApp')->plainTextToken;
                    $this->updateUserWithId($user->id, ["access_token" => $user['access_token']]);
                    $response['status'] = true;
                    $response['data'] = $user;
                    $response['industries'] = $user->industries->id;
                    $response['msg'] = trans('messages.custom.login_messages');
                } else {
                    $response['msg'] = trans('messages.custom.invalid_credential');
                }
            }
            

        }else{
            $response['msg'] = trans('messages.custom.invalid_credential');
        }
        
        return $response;
    }

    public function getSingalUserData($column, $value)
    {
        return AppUser::where($column, $value)->first();
    }

    public function getUserInformation($id)
    {
        $data = AppUser::with(['userSkill.skill', 'userEducation.userCertificate', 'userExperience.userPortfolio', 'userStatement.statement'])->find($id)->toArray();
        if (count($data['user_education']) > 0) {
            foreach ($data['user_education'] as $k => $v) {
                if (count($v['user_certificate']) > 0) {
                    foreach ($v['user_certificate'] as $key => $value) {
                        $data['user_education'][$k]['user_certificate'][$key]['document'] = $value['document'] != null ? FileUploadHelper::getImage($value['document'], 'user_education_certificates') : null;
                    }
                }
            }
        }
        return $data;
    }

    public function logout()
    {
        $user = Auth::user();
        $user->tokens()->delete();
        $update = $this->updateUserWithId($user->id, array('device_token' => null, 'access_token' => null, 'remember_token' => null));
        return $update;
    }

    public function getNotification($request)
    {
        $query = Notification::latest();

        if (isset($request['app_user_id']) && $request['app_user_id'] != null) {
            $query = $query->where('app_user_id', $request['app_user_id']);
        }

        if (isset($request['recruiter_id']) && $request['recruiter_id'] != null) {
            $query = $query->where('recruiter_id', $request['recruiter_id']);
        }

        $date = isset($request['date']) && $request['date'] != null ? CommonHelper::dateFormate($request['date'], 'Y-m-d') : date('y-m-d');
        $from = $date . ' 00:00:01';
        $to = $date . ' 23:59:59';
        return $query->whereBetween('created_at', [$from, $to])->get();
    }

    public function markNotification($request)
    {
        $appId = Auth::user()->id;
        $query = Notification::where('mark_read', 0)->where('app_user_id', $appId);
        if (isset($request['notification_id']) && $request['notification_id'] != null) {
            $query = $query->where('id', $request['notification_id']);
        }
        return $query->update(['mark_read' => 1]);
    }

    public function getDataByColumn($request)
    {
        return  AppUser::where('id', $request->user_id)->update(['status' => $request->status]);
    }
    public function getDataById($column, $value)
    {
        return AppUser::where($column, $value)->first();
    }

    public function getDataByKeyColumn($key, $request)
    {
        return  AppUser::where('id', $key)->update(['status' => $request->status]);
    }

    public function storeData($request)
    {
        $data = $request->all();
        $final = json_decode($request->payment_store_response);

        $orderId ='';
        $packageName = '';
        $productId = '';
        $purchaseTime = '';
        $serializedFinal="";

        if(!empty($final[0])){
            $orderId = $final[0]->orderId;
            $packageName = $final[0]->packageName;
            $productId = $final[0]->productId;

            // Convert milliseconds to seconds
            $purchaseTimeInMillisecond = $final[0]->purchaseTime;
            $purchaseTimeInSeconds = $purchaseTimeInMillisecond / 1000;
            $purchaseTime = date("Y-m-d H:i:s", $purchaseTimeInSeconds);

            $serializedFinal = serialize($final);
        }

        $data['orderId'] =$orderId;
        $data['packageName'] = $packageName;
        $data['productId'] = $productId;
        $data['purchaseTime'] = $purchaseTime;
        $data['payment_date'] = $purchaseTime;
        $data['payment_store_response'] = $serializedFinal;

        return ResumeBuilderSubscription::create($data);
        //return ResumeBuilderSubscription::create($request->all());
    }

    public function getData($request)
    {
        return ResumeBuilderSubscription::with('getUserEducation')->with('getUserStatementData')->with('getUserExperiences')->with('getAppUserData')->where('user_id', $request)->first();
    }

    public function getPdfUrl()
    {
        return ResumeBuilderSubscription::where('user_id', auth()->user()->id)->orderby('id', 'desc')->first();
    }

    public function applyUserDetails($applyAppUserId)
    {
        return AppUser::where('id', $applyAppUserId)->first();
    }

    public function totalUserCountByGender($type)
    {
        return AppUser::when($type=='male',function($query){
            $query->where('gender',1);
        })->when($type=='female',function($query){
            $query->where('gender',2);
        })->count();
    }
    public function totalAppUserAge()
    {
        return AppUser::selectRaw('SUM(TIMESTAMPDIFF(YEAR, dob, CURDATE())) AS total_age')->value('total_age');
    }

    public function stateCurrentWiseUserCount($type,$state){
        return AppUser::when($type == "week",function($query){
            $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        })->when($type == "month",function($query){
            $query->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
        })->when($type == "year", function ($query) {
            $query->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()]);
        })->where('address_state', $state)->count();
    }

    public function stateLastWiseUserCount($type,$state){
        return AppUser::when($type == "week",function($query){
            $query->whereBetween('created_at', [Carbon::now()->startOfWeek()->subWeek(), Carbon::now()->endOfWeek()->subWeek()]);
        })->when($type == "month",function($query){
            $query->whereBetween('created_at', [Carbon::now()->startOfMonth()->subWeek(), Carbon::now()->endOfMonth()->subWeek()]);
        })->where('address_state',$state)->count();
    }

    public function getPaymentDetail()
    {
        $query = ResumeBuilderSubscription::where('user_id', Auth::id())->orderby('id', 'desc')->get();
        $finalArray = [];
        foreach($query as $val){
            $val->payment_store_response = unserialize($val->payment_store_response);
            $finalArray[] = $val;
        }
        return $finalArray;

    }
}
