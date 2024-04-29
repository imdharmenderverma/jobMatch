<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatementSkill extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'statement_skills';
    protected $guarded = ['id'];
}
