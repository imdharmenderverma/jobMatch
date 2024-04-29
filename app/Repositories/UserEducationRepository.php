<?php

namespace App\Repositories;

use App\Interfaces\UserEducationRepositoryInterface;
use App\Models\UserEducation;
use Illuminate\Support\Facades\Auth;

class UserEducationRepository implements UserEducationRepositoryInterface
{
    public function store($request)
    {
        $request['user_id'] = Auth::user()->id;
        return UserEducation::create($request);
    }
   
    public function delete($id)
    {
        return UserEducation::find($id)->delete();
    }
    
    public function getById($id)
    {
        return UserEducation::find($id);
    }
}
