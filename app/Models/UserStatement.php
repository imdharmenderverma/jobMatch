<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStatement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'statement_id',
        'score_no',
        'statement_skill_id',
        'skill_name',
    ];

    public function statement()
    {
        return $this->hasOne(Statement::class, 'id', 'statement_id');
    }
}
