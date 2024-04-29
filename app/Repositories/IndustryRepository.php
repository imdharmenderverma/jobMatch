<?php

namespace App\Repositories;

use App\Interfaces\IndustryRepositoryInterface;
use App\Models\Industry;
use App\Models\IndustrySkill;
use App\Models\Skill;

class IndustryRepository implements IndustryRepositoryInterface
{
    public function store($request)
    {
        $user = Industry::create($request);
        return $user;
    }

    public function get($search = '')
    {
        $query = Industry::latest();
        if ($search != '') {
            $query = $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhereHas('children', function ($q) use ($search) {
                        $q->where('title', 'like', "%{$search}%");
                    });
            });
        }
        $query = $query->get();
        $finalData = [];
        foreach ($query as $key => $value) {
            $finalData[$key]['id'] = $value->id;
            $finalData[$key]['parent_id'] = $value->parent_id;
            $finalData[$key]['title'] = $value->title;
            $finalData[$key]['parent_title'] = $value->children != null ? $value->children->title : '-';
        }
        return json_decode(json_encode($finalData));
    }

    public function getParentIndustry()
    {
        return Industry::whereNull('parent_id')->get();
    }

    public function getParentChild()
    {
        $parentIds = $this->getParentIndustry()->pluck('id')->toArray();
        $data = Industry::whereIn('id', $parentIds)->with('childrens')->get();
        return $data;
    }

    public function ragisterGetParentChild()
    {
        $parentIds = $this->getParentIndustry()->pluck(Industry::Industry_ID)->toArray();
        $data = Industry::whereIn(Industry::Industry_ID, $parentIds)
            ->with(['childrens' => function ($query) {
                $query->orderBy(Industry::TITLE, 'asc'); // Sort children's data alphabetically
            }])
            ->orderBy(Industry::GET_PREVIOUS_EXPERIENCE, 'desc')
            ->orderBy(Industry::TITLE, 'asc') // Sort the rest of the records alphabetically
            ->get();

        return $data;
    }


    public function getPreviousParentIndustry()
    {
        return Industry::whereNull('parent_id')->where('get_previous_experience', null)->get();
    }

    public function getPreviousParentChild()
    {
        $parentIds = $this->getPreviousParentIndustry()->pluck('id')->toArray();

        $data = Industry::whereIn('id', $parentIds)->where('get_previous_experience', null)->with('childrens')->get();
        return $data;
    }

    public function getSkillIndustry($id)
    {
        $skillIds = IndustrySkill::where('industry_id', $id)->pluck('skill_id')->toArray();
        return Skill::whereIn('id', $skillIds)->get();
    }

    public function getChild($id)
    {
        return Industry::whereIn('parent_id', $id)->get();
    }

    public function getDataByColumn($column, $value)
    {
        return Industry::where($column, $value)->first();
    }

    public function update($id, $request)
    {
        return Industry::find($id)->update($request);
    }

    public function delete($id)
    {
        return Industry::find($id)->delete();
    }
}
