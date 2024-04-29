<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Job extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'role_name',
        'company_name',
        'start_date',
        'end_date',
        'description',
        'requirement',
        'location',
        'skill_id',
        'experience',
        'type_of_work',
        'industry',
        'salary_range',
        'status',
        'user_id',
        'latitude',
        'longitude',
        'image',
        'address_state',
    ];

    public function recruiter()
    {
        return $this->hasOne(Recruiter::class, 'id', 'user_id');
    }

    public function industries()
    {
        return $this->hasOne(Industry::class, 'id', 'industry');
    }

    public function jobQuestion()
    {
        return $this->hasMany(JobQuestion::class, 'job_id', 'id');
    }

    public function skill()
    {
        return $this->hasMany(Skill::class, 'id', 'skill_id');
    }
    public function favoriteJobData()
    {
        return $this->hasOne(UserFavoriteJob::class, 'job_id', 'id');
    }
    public function favoriteJobMatch()
    {
        return $this->hasOne(UserFavoriteJob::class, 'job_id', 'id')->where(['app_user_id' => Auth::user()->id]);
    }


    public function applyUser()
    {
        return $this->hasMany(JobApplyUser::class, 'job_id', 'id')->where('status', 0);
    }

    public function checkApplyUser()
    {
        return $this->hasMany(JobApplyUser::class, 'job_id', 'id')->where(['app_user_id' => Auth::user()->id, 'status' => 0]);
    }

    public function matchUser()
    {
        return $this->hasMany(JobMatch::class, 'job_id', 'id')->where('user_not_interested', 0);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = Auth::guard('recruiter')->user()->id;
        });
    }
}
