<?php

namespace App\Repositories;

use App\Interfaces\BusinessRepositoryInterface;
use App\Models\User;

class BusinessRepository implements BusinessRepositoryInterface
{
    const ACTIVE_STATUS = 1;
    const INACTIVE_STATUS = 0;

    public function store($request)
    {
        $user = User::create($request);
        return $user;
    }

    public function updateWithId($id, $data)
    {
        $userData = User::find($id)->update($data);
        return $userData;
    }

}
