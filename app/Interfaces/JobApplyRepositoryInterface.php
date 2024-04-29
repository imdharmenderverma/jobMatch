<?php

namespace App\Interfaces;

interface JobApplyRepositoryInterface
{
    public function store($request);
    public function getSingalData($column, $value);
    public function checkAlreadyJob($jobId);
    public function update($jobId, $appUserId, $data);
    public function storeJobAnswer($request);
    public function getByJobId($jobId);
    public function applyUserDetails($apllyAppUserId);

}
