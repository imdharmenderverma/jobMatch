<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Interfaces\CmsRepositoryInterface;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    protected $cmsRepository = "";
    public function __construct(CmsRepositoryInterface $cmsRepository)
    {
        $this->cmsRepository = $cmsRepository;
    }

    public function termsIndex(Request $request)
    {
        
        $userTermsDetails = $this->cmsRepository->getTermsOfUseData('terms_and_conditions');
        return view('cms', ['data' => $userTermsDetails->description]);
    }
    
    public function privacyIndex()
    {
        $userPrivacyDetails = $this->cmsRepository->getPrivacyPolicyData('privacy_policy');
        return view('cms', ['data' => $userPrivacyDetails->description]);
    }

   
}
