<?php

namespace App\Interfaces;

interface FaqRepositoryInterface
{
    public function store($request);
    public function get();
    public function getData($faq_type);
}
