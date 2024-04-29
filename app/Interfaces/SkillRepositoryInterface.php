<?php

namespace App\Interfaces;

interface SkillRepositoryInterface
{
    public function store($request);
    public function get($search = '');
    public function getDataByColumn($column, $value);
    public function update($id, $request);
    public function delete($id);
    public function getSkillIndustry($id);
}
