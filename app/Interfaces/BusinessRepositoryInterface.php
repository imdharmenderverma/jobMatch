<?php

namespace App\Interfaces;

interface BusinessRepositoryInterface
{
    public function store($request);
    public function updateWithId($id, $data);
}
