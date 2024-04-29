<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserFavoriteJob extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'app_user_id',
        'job_id',
        'favorite_job_no',

    ];
}