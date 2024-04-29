<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Statement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'soft_skill_type',
        'statement_skill_id',
        'page_number',
        'title',
    ];

    public function statementSkill()
    {
        return $this->hasMany(StatementSkill::class, 'id', 'statement_skill_id');
    }
}
