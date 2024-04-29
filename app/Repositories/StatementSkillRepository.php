<?php

namespace App\Repositories;

use App\Interfaces\StatementSkillRepositoryInterface;
use App\Models\StatementSkill;

class StatementSkillRepository implements StatementSkillRepositoryInterface
{
    public function store($request)
    {
        $user = StatementSkill::create($request);
        return $user;
    }

    public function get($search = '')
    {
        $query = StatementSkill::latest();
        if ($search != '') {
            $query = $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%");
            });
        }
       return $query->get();
    }

    public function getDataByColumn($column, $value)
    {
        return StatementSkill::where($column, $value)->first();
    }

    public function update($id, $request)
    {
        return StatementSkill::find($id)->update($request);
    }

    public function delete($id)
    {
        return StatementSkill::find($id)->delete();
    }
}
