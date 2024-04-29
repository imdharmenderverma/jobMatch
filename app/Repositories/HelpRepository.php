<?php

namespace App\Repositories;

use App\Interfaces\HelpRepositoryInterface;
use App\Models\Help;
use Illuminate\Support\Facades\Auth;

class HelpRepository implements HelpRepositoryInterface
{
    public function storeData($request)
    {
        $request['app_user_id'] = Auth::user()->id;
        return Help::create($request);
    }



    public function storeUserData($request)
    {
        return Help::create($request);
    }
}
