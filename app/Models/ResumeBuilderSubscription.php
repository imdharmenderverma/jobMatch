<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class ResumeBuilderSubscription extends Model
{
    use HasFactory, Notifiable,SoftDeletes;

    protected $table = 'resume_builder_subscriptions';
    protected $guarded = ['id'];

    public function getUserEducation()
    {
        return $this->hasMany(UserEducation::class, 'user_id', 'user_id');
    }

    public function getUserExperiences()
    {
        return $this->hasMany(UserPreviousExperience::class, 'user_id', 'user_id')->orderBy('start_date','asc');
    }

    public function getAppUserData()
    {
        return $this->hasOne(AppUser::class, 'id', 'user_id');
    }

    public function getUserStatementData()
    {
        return $this->hasMany(UserStatement::class, 'user_id', 'user_id')->where('category_id', '5');
    }
}
