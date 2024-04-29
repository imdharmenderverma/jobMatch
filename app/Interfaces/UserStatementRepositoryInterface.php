<?php

namespace App\Interfaces;

interface UserStatementRepositoryInterface
{
    public function get($category = '');
    public function store($request);
}
