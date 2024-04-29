<?php

namespace App\Interfaces;

interface JobRepositoryInterface
{
    public function store($request);
    public function get($search = '',  $location = '', $sortBy = '');
    public function getActiveJob();
    public function getAllJob($status = '');
    public function getApplyJob();
    public function getJobByAppUserId($userId, $jobId);
    public function getAppUserById($userId);
    public function getJobByMatchUserId($userId, $jobId);
    public function getJobByMatchUsers($jobId);
    public function getFavJob();
    public function getMatchesJob($request);
    public function getDataByColumn($column, $value);
    public function getJobQuestionById($id);
    public function saveNotInterestedJob($id);
    public function saveResume($request);
    public function saveCoverLetter($request);
    public function update($id, $request);
    public function saveJobFulfill($request);
    public function delete($id);
    public function checkFavorite($id);
    public function storeFavorite($id);
    public function deleteFavorite($id);
    public function getResume($request);
    public function getCoverLetter($request);
    public function getPortfolio($request);
    public function getVideo($request);
    public function calculateAverageVacancyTime($recruiterId);
    public function jobApplayAllUser($jobId);
}
