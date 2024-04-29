<?php

namespace App\Interfaces;

interface AppUserRepositoryInterface
{
    public function updateUserWithId($id, $data);
    public function savePreviousExperience($id, $data);
    public function updatePreviousExperience($updatId, $data);
    public function deletePreviousExperience($id);
    public function getPreviousExperienceById($id);
    public function get($search = '', $filter = [], $location = '');
    public function login($request);
    public function store($request);
    public function delete($id);
    public function logout();
    public function getSingalUserData($column, $value);
    public function getUserInformation($id);
    public function getNotification($request);
    public function markNotification($request);
    public function getDataByColumn($request);
    public function getDataByKeyColumn($id, $request);
    public function storeData($id);
    public function getData($id);
    public function getPdfUrl();
    public function applyUserDetails($apllyAppUserId);

    public function totalUserCountByGender($type);
    public function totalAppUserAge();

    public function stateCurrentWiseUserCount($type,$state);
    public function stateLastWiseUserCount($type,$state); 
    public function getPaymentDetail();
}
