<?php

namespace App\Interfaces;

interface StatementSkillRepositoryInterface
{
    public function store($request);
    public function get($search = '');
    public function getDataByColumn($column, $value);
    public function update($id, $request);
    public function delete($id);
}
