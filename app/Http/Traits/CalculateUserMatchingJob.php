<?php

namespace App\Http\Traits;

use App\Models\Job;
use App\Models\JobMatch;
use App\Models\UserSkill;

trait CalculateUserMatchingJob
{
    public function saveJobMatch($jobId, $appUserId = '')
    {
        $jobData = Job::find($jobId);
        $jobSkills = explode(',', $jobData->skill_id);
        $userSkills = UserSkill::whereIn('skill_id', $jobSkills);

        if ($appUserId != '') {
            $userSkills = $userSkills->where('user_id', $appUserId);
        }
        $userSkills = $userSkills->get()->toArray();

        $collection = collect($userSkills);
        $userSkillMerge = $collection->groupBy('user_id', true)->toArray();

        foreach ($userSkillMerge as $key => $value) {
            $userSkillCount = 0;
            foreach ($value as $v) {
                if (in_array($v['skill_id'], $jobSkills)) {
                    $userSkillCount++;
                }
            }
            $matchingPercentage = ($userSkillCount / count($jobSkills)) * 100;
            $insertData = [
                'app_user_id' => $key,
                'job_id' => $jobId,
                'latitude' => $jobData->latitude,
                'longitude' => $jobData->longitude,
                'match_percentage' => round($matchingPercentage, 2),
            ];
            JobMatch::updateOrCreate(['app_user_id' => $key, 'job_id' => $jobId], $insertData);
        }
    }
}
