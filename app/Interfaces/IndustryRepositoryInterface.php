<?php

namespace App\Interfaces;

interface IndustryRepositoryInterface
{
    public function store($request);
    public function get($search = '');
    public function getDataByColumn($column, $value);
    public function update($id, $request);
    public function delete($id);
    public function getParentIndustry();
    public function getParentChild();
    public function getSkillIndustry($id);
    public function getChild($id);
    public function ragisterGetParentChild();


    public function getPreviousParentChild();
    public function getPreviousParentIndustry();
}
