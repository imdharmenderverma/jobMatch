<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Industry;
use Carbon\Carbon;

class AppUser extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'dob',
        'email',
        'phone_number',
        'password',
        'phone_number',
        'profile_photo_path',
        'gender_type',
        'status',
        'otp',
        'device_token',
        'access_token',
        'show_profile',
        'location',
        'location_range',
        'latitude',
        'longitude',
        'min_income_expected',
        'max_income_expected',
        'industry',
        'open_to_negotiation',
        'work_type',
        'work_preference',
        'executive_summary',
        'tell_us_about_screen',
        'your_skill_screen',
        'user_statement_screen',
        'soft_skill_screen',
        'your_previous_experience_screen',
        'your_education_detail_screen',
        'upload_video_screen',
        'upload_cover_letter_screen',
        'upload_resume_screen',
        'your_information_screen',
        'video',
        'cover_letter_id',
        'resume_id',
        'disable_job',
        'industry_id',
        'address_state',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userSkill()
    {
        return $this->hasMany(UserSkill::class, 'user_id', 'id');
    }

    public function userStatement()
    {
        return $this->hasMany(UserStatement::class, 'user_id', 'id');
    }

    public function userEducation()
    {
        return $this->hasMany(UserEducation::class, 'user_id', 'id');
    }

    public function userExperience()
    {
        return $this->hasMany(UserPreviousExperience::class, 'user_id', 'id');
    }

    public function jobMatch()
    {
        return $this->hasMany(JobMatch::class, 'app_user_id', 'id');
    }

    public function industries()
    {
        return $this->hasOne(Industry::class, 'title', 'industry');
    }

    public function matchUser()
    {
        return $this->hasMany(JobMatch::class, 'app_user_id', 'id')->where('user_not_interested', 0);
    }
    public function getIndustriesId($name)
    {
        return  Industry::whereIn('id', $name)->get();
    }

    public function getAppUserCount()
    {
        return AppUser::count();
    }
    public function getSalaryRange()
    {
        return Job::pluck('salary_range');
    }

    public function getSalaryRangeNew($typeOfWork)
    {
        return Job::where('type_of_work', $typeOfWork)->pluck('salary_range');
    }

    public function getAverageTimeFile()
    {
        $jobFulfills = JobFulfill::all();
        if ($jobFulfills->isEmpty()) {
            return 0;
        }
        $totalDaysToFill = $jobFulfills->sum(function ($jobFulfill) {
            return $jobFulfill->created_at->diffInDays(Carbon::now());
        });
        $averageDaysToFill = $totalDaysToFill / $jobFulfills->count();
        $roundedAverageDaysToFill = (int) ceil($averageDaysToFill);

        return $roundedAverageDaysToFill;
    }

    public function getSavedJob()
    {
        $savedJobs = UserFavoriteJob::get();
        $totalJobs = Job::count(); // Assuming you have a "Job" model
        if ($savedJobs->isEmpty() || $totalJobs === 0) {
            return 0;
        }
        $percentageSavedJobs = ($savedJobs->count() / $totalJobs) * 100;

        return $percentageSavedJobs;
    }

    public function getNumberOfApplicantsJob()
    {
        $numberOfApplicantsPerJob = JobApplyUser::groupBy('job_id')
            ->select('job_id', \DB::raw('count(*) as total_applicants'))
            ->get();
        foreach ($numberOfApplicantsPerJob as $job) {
            $jobId = $job->job_id;
            return  $job->total_applicants;
        }
    }

    public function getPeopleMatched()
    {
        $getPeopleMatched = UserSkill::select('skill_id', \DB::raw('count(user_id) as user_count'))
            ->groupBy('skill_id')
            ->get();

        $totalUsers = UserSkill::distinct('user_id')->count();

        foreach ($getPeopleMatched as $match) {
            $skillId = $match->skill_id;
            $userCount = $match->user_count;


            return number_format(($userCount / $totalUsers) * 100, 2);
        }
    }
}
