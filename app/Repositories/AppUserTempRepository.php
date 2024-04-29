<?php

namespace App\Repositories;

use App\Http\Traits\ImageUploadTrait;
use App\Interfaces\AppUserTempRepositoryInterface;
use App\Models\AppUserTemp;

class AppUserTempRepository implements AppUserTempRepositoryInterface
{
    use ImageUploadTrait;

    public function store($request)
    {
        if (isset($request['profile_photo_path']) && $request['profile_photo_path'] != null) {
            $request['profile_photo_path'] = $this->storeImage($request['profile_photo_path'], 'app_users');
        }
        return AppUserTemp::updateOrCreate(['email' => $request['email']], $request);
    }

    public function delete($id)
    {
        return AppUserTemp::find($id)->delete();
    }

    public function updateUserWithId($id, $data)
    {
        return AppUserTemp::find($id)->update($data);
    }

    public function getSingalUserData($column, $value)
    {
        return AppUserTemp::where($column, $value)->first();
    }
}
