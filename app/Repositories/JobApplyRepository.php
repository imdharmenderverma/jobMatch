<?php

namespace App\Repositories;

use App\Interfaces\JobApplyRepositoryInterface;
use App\Models\AppUser;
use App\Models\JobApplyUser;
use App\Models\JobQuestionAnswer;
use Illuminate\Support\Facades\Auth;

class JobApplyRepository implements JobApplyRepositoryInterface
{
    public function store($request)
    {
        return JobApplyUser::create($request);
    }

    public function getSingalData($column, $value)
    {
        return JobApplyUser::where($column, $value)->first();
    }
    
    public function checkAlreadyJob($jobID)
    {
        $userId = Auth::user()->id;
        return JobApplyUser::where(['app_user_id' => $userId, 'job_id' => $jobID])->first();
    }
   
    public function update($jobId, $appUserId, $data)
    {
        return JobApplyUser::where(['app_user_id' => $appUserId, 'job_id' => $jobId])->update($data);

        
    }

    public function getByJobId($jobId)
    {
        return JobApplyUser::where('job_id',$jobId)->get();
        
    }

    public function applyUserDetails($apllyAppUserId){
        return AppUser::where('id',$apllyAppUserId)->first();
    }
    
    public function storeJobAnswer($data)
    {
        $userId = Auth::user()->id;
        foreach($data as $d) {
            JobQuestionAnswer::create(['job_question_id' => $d['job_question_id'], 'answer' => $d['answer'], 'app_user_id' => $userId]);
        }
        return true;
    }
}
