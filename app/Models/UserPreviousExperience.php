<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPreviousExperience extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company',
        'industry',
        'title',
        'job_duties',
        'start_date',
        'end_date',
        'tick_box',
    ];

    public function userPortfolio()
    {
        return $this->hasMany(UserPortfolio::class, 'experience_id', 'id');
    }
}
