<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobFulfill extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'app_user_id',
        'status'
    ];
}
