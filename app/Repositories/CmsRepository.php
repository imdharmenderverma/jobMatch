<?php

namespace App\Repositories;

use App\Interfaces\CmsRepositoryInterface;
use App\Models\Cms;

class CmsRepository implements CmsRepositoryInterface
{

    public function getPrivacyPolicyData($type)
    {
        $query = Cms::where('type', $type)->first();
        return $query;
    }

    public function updatePrivacyPolicyData($request)
    {
        return Cms::updateOrCreate(array('type' => $request->type), $request->all());
    }

    public function updatePrivacyPolicy($type, $request)
    {
        return Cms::updateOrCreate(array('type' => $request->type, "cms_type" => $type), $request->all());
    }

    public function getTermsOfUseData($type)
    {
       
        $query = Cms::where('type', $type)->first();
        return $query;
    }

    public function updateTermsOfUseData($request)
    {
        return Cms::updateOrCreate(array('type' => $request->type), $request->all());
    }

    public function updateTermsOfUse($type, $request)
    {
        return Cms::updateOrCreate(array('type' => $request->type, "cms_type" => $type), $request->all());
    }



    public function getCms($type)
    {
        $query = Cms::where('type', $type)->first();
        return $query;
    }

    public function getCmsData($type)
    {
        return  Cms::where('cms_type', $type)->orderby('id', 'desc')->get();
    }

    public function getTermsCmsData($type)
    {
        return  Cms::where('type', $type)->where('cms_type', 2)->first();
    }

    public function getprivacyCmsData($type)
    {
        return  Cms::where('type', $type)->where('cms_type', 2)->first();
    }
}
