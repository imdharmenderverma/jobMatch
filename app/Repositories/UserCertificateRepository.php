<?php

namespace App\Repositories;

use App\Helpers\FileUploadHelper;
use App\Interfaces\UserCertificateRepositoryInterface;
use App\Models\UserEducationCertificate;
use Illuminate\Support\Facades\Auth;

class UserCertificateRepository implements UserCertificateRepositoryInterface
{
    public function store($educationId, $request)
    {
        $userId = Auth::user()->id;
        foreach ($request as $value) {
            $value['user_id'] = $userId;
            $value['user_education_id'] = $educationId;
            if (isset($value['document']) && $value['document'] != null) {
                $value['document'] = FileUploadHelper::imageUpload($value['document'], 'user_education_certificates');
            }
            UserEducationCertificate::create($value);
        }
        return true;
    }

    public function delete($id)
    {
        return UserEducationCertificate::find($id)->delete();
    }
    
    public function getById($id)
    {
        return UserEducationCertificate::find($id);
    }
}
