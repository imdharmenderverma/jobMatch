<?php

namespace App\Interfaces;

interface RecruiterRepositoryInterface
{
    public function store($request);
    public function updateWithId($id, $data);
    public function updateWithColumn($column, $value, $data);
    public function checkEmail($request);
    public function checkEmailToForgot($token, $email = '');
    public function get($search = '', $filter = [], $location = '');
    public function delete($id);
    public function forgotPassword($token, $email);
    public function deleteForgotEmail($email);
    public function getDataByColumn($column, $value);
    public function getData($request);
    public function geLastExperiences($request);
    public function emilVerify($id);
}
