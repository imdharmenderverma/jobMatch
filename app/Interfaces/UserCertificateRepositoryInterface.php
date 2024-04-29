<?php

namespace App\Interfaces;

interface UserCertificateRepositoryInterface
{
    public function store($educationId, $request);
    public function delete($id);
    public function getById($id);
}
