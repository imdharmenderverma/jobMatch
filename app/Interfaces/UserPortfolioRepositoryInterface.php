<?php

namespace App\Interfaces;

interface UserPortfolioRepositoryInterface
{
    public function store($experienceId, $request);
    public function delete($id);
    public function getById($id);
}
