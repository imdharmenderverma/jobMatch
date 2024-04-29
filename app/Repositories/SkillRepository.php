<?php

namespace App\Repositories;

use App\Interfaces\SkillRepositoryInterface;
use App\Models\IndustrySkill;
use App\Models\Skill;

class SkillRepository implements SkillRepositoryInterface
{
    public function store($request)
    {
        $industry = $request['industry_id'];
        $request['industry_id'] = implode(',', $industry);
        $skill = Skill::create($request);
        foreach ($industry as $value) {
            IndustrySkill::create(['skill_id' => $skill->id, 'industry_id' => $value]);            
        }
        return $skill;
    }

    public function get($search = '')
    {
        $query = Skill::latest();
        if ($search != '') {
            $query = $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%");
            });
        }
        return $query->get();        
    }

    public function getDataByColumn($column, $value)
    {
        return Skill::where($column, $value)->first();
    }

    public function update($id, $request)
    {
        $industry = $request['industry_id'];
        $request['industry_id'] = implode(',', $industry);

        IndustrySkill::where('skill_id', $id)->delete();

        foreach ($industry as $value) {
            IndustrySkill::create(['skill_id' => $id, 'industry_id' => $value]);            
        }

        return Skill::find($id)->update($request);
    }

    public function delete($id)
    {
        return Skill::find($id)->delete();
    }
    
    public function getSkillIndustry($id)
    {
        $skillIds = IndustrySkill::where('industry_id', $id)->pluck('skill_id')->toArray();
        return Skill::whereIn('id', $skillIds)->get();
    }
}
