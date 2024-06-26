<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPortfolio extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'experience_id',
        'title',
        'description',
        'start_date',
        'end_date',
    ];
}
