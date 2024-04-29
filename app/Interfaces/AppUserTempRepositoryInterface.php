<?php

namespace App\Interfaces;

interface AppUserTempRepositoryInterface
{
    public function store($request);
    public function delete($id);
    public function getSingalUserData($column, $value);
    public function updateUserWithId($id, $data);
}
