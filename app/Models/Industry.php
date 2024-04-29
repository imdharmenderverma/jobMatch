<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Industry extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'parent_id',
        'title'
    ];
    const Industry_ID = 'id';
    const GET_PREVIOUS_EXPERIENCE = 'get_previous_experience';
    const GET_PREVIOUS_NOT_SET = '0';
    const TITLE = 'title';

    public function children()
    {
        return $this->hasOne(Industry::class, 'id', 'parent_id');
    }

    public function childrens()
    {
        return $this->hasMany(Industry::class, 'parent_id', 'id');
    }

    public function Getindustry()
    {
        return Industry::get();
    }
}
