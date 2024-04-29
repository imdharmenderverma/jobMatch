<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InboxHelp extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'inbox_helps';
    protected $guarded = ['id'];

    public const app_user_id = 'app_user_id';
    public const recruiter_id = 'recruiter_id';

    public const c_question = 'question';
    public const c_answer = 'answer';
    public const c_created_at = 'created_at';

    public function appUserData()
    {
        return $this->hasOne(AppUser::class, 'id', 'app_user_id');
    }

    public function recruiter()
    {
        return $this->hasOne(Recruiter::class, 'id', 'recruiter_id');
    }
}
