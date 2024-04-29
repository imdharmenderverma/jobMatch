<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobMatch extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'app_user_id',
        'job_id',
        'match_percentage',
        'user_not_interested',
        'recruiter_not_interested',
        'latitude',
        'longitude',
    ];

    public function appUser()
    {
        return $this->hasOne(AppUser::class, 'id', 'app_user_id');
    }

    public function job()
    {
        return $this->hasOne(Job::class, 'id', 'job_id');
    }
}
