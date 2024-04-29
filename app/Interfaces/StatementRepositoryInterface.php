<?php

namespace App\Interfaces;

interface StatementRepositoryInterface
{
    public function get($search = '', $request = []);
    public function getScoreSkillList($search = '', $request = []);
    public function store($request);
    public function getDataByColumn($column, $value);
    public function update($id, $request);
    public function delete($id);
}
