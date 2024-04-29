<?php

namespace App\Interfaces;

interface UserSkillRepositoryInterface
{
    public function get();
    public function getSoftSkill();
    public function store($request);
    public function update($id, $request);
    public function delete($id);
}
