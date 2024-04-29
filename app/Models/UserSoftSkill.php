<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSoftSkill extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'statement_skill_id',
        'title',
    ];

    public function softSkill(){
        return $this->hasOne(StatementSkill::class, 'id', 'statement_skill_id');
    }
}
