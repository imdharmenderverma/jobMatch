<?php

namespace App\Repositories;

use App\Helpers\CommonHelper;
use App\Http\Traits\ImageUploadTrait;
use App\Interfaces\JobRepositoryInterface;
use App\Models\AppUser;
use App\Models\Job;
use App\Models\JobApplyUser;
use App\Models\JobFulfill;
use App\Models\JobMatch;
use App\Models\JobQuestion;
use App\Models\Skill;
use App\Models\UserCoverLetter;
use App\Models\UserFavoriteJob;
use App\Models\UserPortfolio;
use App\Models\UserPreviousExperience;
use App\Models\UserResume;
use Carbon\CarbonInterval;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JobRepository implements JobRepositoryInterface
{
    use ImageUploadTrait;
    public function store($request)
    {
        $userId = Auth::guard('recruiter')->user()->id;
        $request['skill_id'] = implode(',', $request['skill_id']);

        $job = Job::create($request);

        if (isset($request['question_1'])) {
            foreach ($request['question_1'] as $key => $value) {
                if (!empty($value)) {
                    JobQuestion::create(['user_id' => $userId, 'job_id' => $job->id, 'question_1' => $value]);
                }
            }
        }
        return $job;
    }

    public function get($search = '',  $location = '', $sortBy = '')
    {

        $userId = Auth::guard('recruiter')->user()->id;
        $query = Job::with(['applyUser.appUser', 'matchUser.appUser', 'industries'])->withCount(['applyUser', 'matchUser'])->where('user_id', $userId);
        if ($search != '') {
            $query = $query->where(function ($q) use ($search) {
                $q->orWhere('role_name', 'like', "%{$search}%")
                    ->orWhere('company_name', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if ($location != '') {
            $array = explode(" ", $location);
            $query = $query->where(function ($q) use ($array) {
                foreach ($array as $searchLocation) {
                    $q->orWhere('location', 'like', "%{$searchLocation}%");
                }
            });
        }

        foreach ($query as $key => $value) {
            $query[$key]->skill = Skill::whereIn('id', explode(',', $value->skill_id));
        }

        if ($sortBy == 1) {
            $query = $query->orderBy('role_name', 'asc')->orderBy('company_name', 'asc');
        } else {
            $query = $query->orderBy('id', 'desc');
        }

        return $query;
    }

    public function getActiveJob()
    {
        $userId = Auth::guard('recruiter')->user()->id;
        $query = Job::with(['applyUser.appUser', 'matchUser.appUser', 'industries'])->withCount(['applyUser', 'matchUser'])->where('user_id', $userId)->where('status', 1)->orderBy('id', 'desc')->paginate(6);
        foreach ($query as $key => $value) {
            $query[$key]->skill = Skill::whereIn('id', explode(',', $value->skill_id))->get();
            $query[$key]->type_of_work_name = CommonHelper::jobWorkTypeText($value->type_of_work);
            $query[$key]->industry_name = $value->industries->title ?? '';
            $query[$key]->created_at = CommonHelper::dateFormate($value->created_at, 'd-m-Y');
            $query[$key]->start_date = CommonHelper::dateFormate($value->start_date, 'd/m/Y');
            $query[$key]->end_date = CommonHelper::dateFormate($value->end_date, 'd/m/Y');
        }
        return $query;
    }

    public function getAllJob($status = '')
    {
        $jobs = Job::orderBy('id', 'desc');
        if ($status != '') {
            $jobs = $jobs->where('status', $status);
        }
        return $jobs->get();
    }

    public function getApplyJob()
    {
        $userId = Auth::user()->id;
        $jobIds = JobApplyUser::where(['app_user_id' => $userId, 'status' => 0, 'apply_or_not' => 0])->pluck('job_id')->toArray();
        $jobs = Job::with(['jobQuestion', 'checkApplyUser', 'industries'])->whereIn('id', $jobIds)->orderBy('id', 'desc')->get();

        foreach ($jobs as $key => $value) {
            $jobs[$key]->type_of_work_name = CommonHelper::jobWorkTypeText($value->type_of_work);
            $jobs[$key]->industry_name = $value->industries->title ?? '';
            $jobs[$key]->start_date = CommonHelper::dateFormate($value->start_date, 'd-m-Y');
            $jobs[$key]->end_date = CommonHelper::dateFormate($value->end_date, 'd-m-Y');
            $jobs[$key]->skills = Skill::whereIn('id', explode(',', $value->skill_id))->get();
            $jobs[$key]->check_apply_user = (count($value->checkApplyUser) > 0) ? true : false;
            unset($jobs[$key]->checkApplyUser);
        }
        return $jobs;
    }

    public function getFavJob()
    {
        $userId = Auth::user()->id;

        $jobIds = UserFavoriteJob::where(['app_user_id' => $userId, 'favorite_job_no' => 1])->pluck('job_id')->toArray();
        $jobs = Job::with(['jobQuestion', 'checkApplyUser', 'industries'])->whereIn('id', $jobIds)->orderBy('id', 'desc')->get();

        foreach ($jobs as $key => $value) {
            $jobs[$key]->type_of_work_name = CommonHelper::jobWorkTypeText($value->type_of_work);
            $jobs[$key]->industry_name = $value->industries->title ?? '';
            $jobs[$key]->start_date = CommonHelper::dateFormate($value->start_date, 'd-m-Y');
            $jobs[$key]->end_date = CommonHelper::dateFormate($value->end_date, 'd-m-Y');
            $jobs[$key]->skills = Skill::whereIn('id', explode(',', $value->skill_id))->get();
            $jobs[$key]->check_apply_user = (count($value->checkApplyUser) > 0) ? true : false;
            unset($jobs[$key]->checkApplyUser);
        }
        // dd($jobs);
        return $jobs;
    }

    public function getDataByColumn($column, $value)
    {
        $data = Job::with(['jobQuestion', 'checkApplyUser', 'recruiter', 'industries'])->where($column, $value)->first();
        if ($data) {
            $data['skills'] = Skill::whereIn('id', explode(',', $data->skill_id))->get();
            $data['type_of_work_name'] = CommonHelper::jobWorkTypeText($data['type_of_work']);
            $data['industry_name'] = $data['industries']['title'] ?? '';
            $data['check_apply_user'] = (count($data['checkApplyUser']) > 0) ? true : false;
            unset($data['checkApplyUser']);
        }
        return $data;
    }

    public function getJobQuestionById($id)
    {
        return Job::with(['jobQuestion', 'applyUser.appUser', 'matchUser.appUser'])->withCount(['applyUser', 'matchUser'])->find($id);
    }

    public function getJobByAppUserId($userId, $jobId)
    {
        return JobApplyUser::with(['appUser.userSkill.skill', 'appUser.userEducation.userCertificate', 'appUser.userExperience', 'job.jobQuestion'])->where(['app_user_id' => $userId, 'job_id' => $jobId])->first();
    }

    public function getAppUserById($userId)
    {
        return AppUser::with(['userSkill.skill', 'userEducation.userCertificate', 'userExperience'])->where('id', $userId)->first();
    }

    public function getJobByMatchUserId($userId, $jobId)
    {
        return JobMatch::with(['appUser.userSkill.skill', 'appUser.userEducation.userCertificate', 'appUser.userExperience', 'job.jobQuestion'])->where(['app_user_id' => $userId, 'job_id' => $jobId])->first();
    }

    public function getJobByMatchUsers($jobId)
    {
        return JobApplyUser::with(['appUser.userSkill.skill', 'appUser.userEducation.userCertificate', 'appUser.userExperience', 'job.jobQuestion'])->where(['job_id' => $jobId])->get();
    }

    public function update($id, $request)
    {
        $job = Job::find($id);
        if (isset($request['image']) && $request['image'] != null) {
            if ($job->image != null) {
                $this->deleteImage($job->image, 'jobs');
            }
            $request['image'] = $this->storeImage($request['image'], 'jobs');
        }
        if (isset($request['skill_id'])) {
            $request['skill_id'] = implode(',', $request['skill_id']);
        }
        $job->update($request);
        $userId = Auth::guard('recruiter')->user()->id;
        if (isset($request['question_1'])) {
            JobQuestion::where(['user_id' => $userId, 'job_id' => $job->id])->delete();
            foreach ($request['question_1'] as $key => $value) {
                if ($value != null) {
                    JobQuestion::create(['user_id' => $userId, 'job_id' => $job->id, 'question_1' => $value]);
                }
            }
        }
        return $job;
    }

    public function delete($id)
    {
        $job = Job::find($id);
        $this->deleteImage($job->image, 'jobs');
        UserFavoriteJob::where('job_id', $id)->delete();
        JobMatch::where('job_id', $id)->delete();
        return $job->delete();
    }

    public function checkFavorite($id)
    {
        $userId = Auth::user()->id;
        return UserFavoriteJob::where(['job_id' => $id, 'app_user_id' => $userId])->first();
    }

    public function storeFavorite($id)
    {
        $userId = Auth::user()->id;
        return UserFavoriteJob::create([
            'job_id' => $id, 'app_user_id' => $userId, 'favorite_job_no' => 1
        ]);
    }

    public function saveJobFulfill($request)
    {
        return JobFulfill::create($request);
    }

    public function deleteFavorite($id)
    {
        $userId = Auth::user()->id;
        return UserFavoriteJob::where(['job_id' => $id, 'app_user_id' => $userId])->delete();
    }

    public function saveNotInterestedJob($id)
    {
        $userId = Auth::user()->id;
        $saveNotInterestedJob = [
            'apply_or_not' => 1,
            'job_id' => $id,
            'app_user_id' => $userId,
            'created_by' => $userId,
        ];
        return JobApplyUser::create($saveNotInterestedJob);
    }

    public function saveResume($request)
    {
        $userId = Auth::user()->id;
        $jobId = isset($request['job_id']) && $request['job_id'] != null ? $request['job_id'] : null;
        $data = UserResume::create(['app_user_id' => $userId, 'file' => $this->storeImage($request['file'], 'user_resumes'), 'job_id' => $jobId]);
        if (isset($request['is_active']) && $request['is_active'] == true) {
            AppUser::find($userId)->update(['resume_id' => $data->id]);
        }
        return $data;
    }

    public function saveCoverLetter($request)
    {
        $userId = Auth::user()->id;
        $jobId = isset($request['job_id']) && $request['job_id'] != null ? $request['job_id'] : null;
        $data = UserCoverLetter::create(['app_user_id' => $userId, 'file' => $this->storeImage($request['file'], 'job_cover_letteres'), 'job_id' => $jobId]);
        if (isset($request['is_active']) && $request['is_active'] == true) {
            AppUser::find($userId)->update(['cover_letter_id' => $data->id]);
        }
        return $data;
    }

    public function getMatchesJob($request)
    {
        if (isset($request['latitude']) && isset($request['longitude']) && isset($request['radius'])) {
            $jobIds = $this->getLocationByJob($request['latitude'], $request['longitude'], $request['radius']);
        } else {
            $jobIds = JobMatch::where('user_not_interested', 0)->pluck('job_id')->toArray();
        }

        $jobId = JobApplyUser::where(["app_user_id" => Auth::user()->id])->get()->pluck("job_id");

        $jobs = Job::with(['jobQuestion', 'checkApplyUser', 'industries', 'favoriteJobMatch'])->whereNotIn('id', $jobId)->whereIn('id', $jobIds)->orderBy('id', 'desc')->get();
        foreach ($jobs as $key => $value) {
            $jobs[$key]->type_of_work_name = ($value->type_of_work != null) ? CommonHelper::jobWorkTypeText($value->type_of_work) : '';
            $jobs[$key]->industry_name = $value->industries->title ?? '';
            $jobs[$key]->start_date = $value->start_date != null ? CommonHelper::dateFormate($value->start_date, 'd-m-Y') : null;
            $jobs[$key]->end_date = $value->end_date != null ? CommonHelper::dateFormate($value->end_date, 'd-m-Y') : null;
            $jobs[$key]->skills = Skill::whereIn('id', explode(',', $value->skill_id))->get();
            $jobs[$key]->check_apply_user = (count($value->checkApplyUser) > 0) ? true : false;
            unset($jobs[$key]->checkApplyUser);
        }

        return $jobs;
    }

    public function getLocationByJob($latitude, $longitude, $radius)
    {
        $data = JobMatch::select('id', 'job_id', 'latitude', 'longitude', DB::raw("6371 * acos(cos(radians(" . $latitude . ")) * cos(radians(latitude)) * cos(radians(longitude) - radians(" . $longitude . ")) + sin(radians(" . $latitude . ")) * sin(radians(latitude))) AS distance"))->where('user_not_interested', 0)->having('distance', '<=', $radius)->pluck('job_id')->toArray();
        return $data;
    }

    public function getResume($request)
    {
        $query = UserResume::where('app_user_id', $request['user_id']);
        if (isset($request['job_id']) && $request['job_id'] != null) {

            $query = $query->where('job_id', $request['job_id']);
        }
        return $query->get();
    }

    public function getCoverLetter($request)
    {
        $query = UserCoverLetter::where('app_user_id', $request['user_id']);
        if (isset($request['job_id']) && $request['job_id'] != null) {
            $query = $query->where('job_id', $request['job_id']);
        }
        return $query->get();
    }

    public function getPortfolio($request)
    {
        return UserPreviousExperience::with('userPortfolio')->where('user_id', $request['user_id'])->get();
    }

    public function getVideo($request)
    {
        return AppUser::where('id', $request['user_id'])->first();
    }

    public function calculateAverageVacancyTime($recruiterId)
    {
        $averageVacancyTimeInSeconds = Job::join('job_matches', 'jobs.id', '=', 'job_matches.job_id')
            ->select(DB::raw('AVG(TIMESTAMPDIFF(SECOND, jobs.updated_at, job_matches.updated_at)) AS average_vacancy_time_seconds'))
            ->where('user_id', $recruiterId)->first();
        $averageVacancyTimeInDays = CarbonInterval::seconds($averageVacancyTimeInSeconds->average_vacancy_time_seconds)->cascade()->format('%d days');
        return $averageVacancyTimeInDays;
    }

    public function jobApplayAllUser($jobId)
    {
        return JobApplyUser::with('appUser')->where('job_id', $jobId)->get();
    }
}
