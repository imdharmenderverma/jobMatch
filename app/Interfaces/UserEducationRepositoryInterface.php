<?php

namespace App\Interfaces;

interface UserEducationRepositoryInterface
{
    public function store($request);
    public function delete($id);
    public function getById($id);
}
