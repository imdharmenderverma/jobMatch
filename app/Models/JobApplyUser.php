<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class JobApplyUser extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'app_user_id',
        'job_id',
        'status',
        'apply_or_not',
        'created_by',
    ];

    public function appUser()
    {
        return $this->hasOne(AppUser::class, 'id', 'app_user_id');
    }

    public function job()
    {
        return $this->hasOne(Job::class, 'id', 'job_id');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->app_user_id = Auth::user()->id;
        });
    }
}
