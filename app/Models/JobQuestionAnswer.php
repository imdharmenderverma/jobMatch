<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobQuestionAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'app_user_id',
        'job_question_id',
        'answer',
    ];
}
