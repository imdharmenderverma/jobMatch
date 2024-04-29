<?php

namespace App\Interfaces;

interface InboxRepositoryInterface
{

    public function get($search = '');
    public function getHelp($search = '');
    public function getDataByColumn($user_id);
    public function store($request);
    public function update($id);
    public function getHelpUser($id);
    public function updateHelp($id);
}
