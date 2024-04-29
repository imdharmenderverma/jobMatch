<?php

namespace App\Repositories;

use App\Interfaces\InboxRepositoryInterface;

use App\Models\Help;
use App\Models\InboxHelp;
use Illuminate\Support\Facades\Auth;

class InboxRepository implements InboxRepositoryInterface
{

    public function get($search = '')
    {
        return InboxHelp::with(['appUserData', 'recruiter'])->orderBy('id', 'DESC')->get();
    }

    public function getDataByColumn($user_id)
    {
        return InboxHelp::with(['appUserData', 'recruiter'])->where('id', $user_id)->first();
    }


    public function store($request)
    {

        $user = InboxHelp::create($request);
        return $user;
    }

    public function update($id)
    {
        return InboxHelp::where('id', $id)->update(['flag_status' => '1']);
    }

    public function getHelp($search = '')
    {
        return Help::with(['appUserData', 'recruiter'])->orderBy('id', 'DESC')->get();
    }

    public function getHelpUser($id)
    {
        return Help::with(['appUserData', 'recruiter'])->where('id', $id)->first();
    }


    public function updateHelp($id)
    {
        return Help::where('id', $id)->update(['flag_status' => '1']);
    }
}
