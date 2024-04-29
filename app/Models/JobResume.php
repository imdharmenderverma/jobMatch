<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobResume extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
        'job_id',
        'app_user_id'
    ];
}
