<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserCoverLetter extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'file',
        'app_user_id',
        'job_id'
    ];
}
