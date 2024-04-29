<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Help extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'helps';
    protected $guarded = ['id'];

    public function appUserData()
    {
        return $this->hasOne(AppUser::class, 'id', 'app_user_id');
    }
    public function recruiter()
    {
        return $this->hasOne(Recruiter::class, 'id', 'recruiter_id');
    }
}
