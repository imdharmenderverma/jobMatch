<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserEducation extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_educations';
    protected $fillable = [
        'user_id',
        'school',
        'study_type',
        'degree',
        'field_of_study',
        'start_date',
        'end_date',
    ];

    public function userCertificate()
    {
        return $this->hasMany(UserEducationCertificate::class, 'user_education_id', 'id');
    }

    
    
}
