<?php

namespace App\Repositories;

use App\Interfaces\UserSkillRepositoryInterface;
use App\Models\UserSkill;
use App\Models\UserSoftSkill;
use App\Models\UserStatement;
use Illuminate\Support\Facades\Auth;

class UserSkillRepository implements UserSkillRepositoryInterface
{
    public function get()
    {
        $userId = Auth::user()->id;
        $data = UserSkill::with('skill')->where('user_id', $userId)->get();
        foreach ($data as $key => $value) {
            $data[$key]->skill_name = $value->skill != null ? $value->skill->title : '';
        }
        return $data;
    }

    public function getSoftSkill()
    {
        $userId = Auth::user()->id;
        $data = UserStatement::where('user_id', $userId)
            ->where('category_id', '5')
            ->orderBy('score_no', 'desc') // Use 'orderBy' instead of 'ordrby'
            ->get();
        foreach ($data as $key => $value) {
            $data[$key]->title = $value->softSkill != null ? $value->softSkill->title : $value->title;
            unset($value->softSkill);
        }
        return $data;
    }

    public function store($request)
    {
        $userId = Auth::user()->id;
        UserSkill::where('user_id', $userId)->delete();
        $skills = explode(',', $request['skill_id']);
        foreach ($skills as $value) {
            $data = [
                'user_id' => $userId,
                'skill_id' => $value
            ];
            UserSkill::create($data);
        }
        return true;
    }

    public function update($id, $request)
    {
        return UserSkill::find($id)->update($request);
    }

    public function delete($id)
    {
        return UserSkill::find($id)->delete();
    }
}
