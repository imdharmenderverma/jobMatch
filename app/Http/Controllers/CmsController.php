<?php

namespace App\Http\Controllers;

use App\Interfaces\CmsRepositoryInterface;
use App\Models\Cms;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    protected $cmsRepository = "";
    public function __construct(CmsRepositoryInterface $CmsRepository)
    {
        $this->cmsRepository = $CmsRepository;
    }

    public function privacyIndex(Request $request)
    {
        $requestUserType = $request->get("type");

        $privacyDetails = $this->cmsRepository->getPrivacyPolicyData('privacy_policy', $requestUserType);
        return view('admin.privacy-policy.index', compact('privacyDetails'));
    }


    public function privacyUpdate(Request $request)
    {
        if ($request->get("user_type")) {
            $update = $this->cmsRepository->updatePrivacyPolicy($request->get("user_type"), $request);
        } else {
            $update = $this->cmsRepository->updatePrivacyPolicyData($request);
        }
        if ($update) {
            return $this->sendResponse(true, $update, trans('messages.custom.cms_update'), $this->successStatus);
        } else {
            return $this->sendResponse(false, [], trans(
                'messages.custom.cms_error'
            ), $this->errorStatus);
        }
    }

    public function termsIndex(Request $request)
    {
        $requestUserType = $request->get("type");
        $termsDetails = $this->cmsRepository->getTermsOfUseData('terms_and_conditions', $requestUserType);
        return view('admin.terms-and-conditions.index', compact('termsDetails'));
    }

    public function termsUpdate(Request $request)
    {
        if ($request->get("user_type")) {
            $update = $this->cmsRepository->updatePrivacyPolicy($request->get("user_type"), $request);
        } else {
            $update = $this->cmsRepository->updateTermsOfUseData($request);
        }
        if ($update) {
            return $this->sendResponse(true, $update, trans('messages.custom.cms_update'), $this->successStatus);
        } else {
            return $this->sendResponse(false, [], trans(
                'messages.custom.cms_error'
            ), $this->errorStatus);
        }
    }

    public function cmsIndex(Request $request)
    {
        $getUserCmsData = $this->cmsRepository->getCmsData(1);
        $getbuisnessCmsData = $this->cmsRepository->getCmsData(2);
        return view('admin.terms-and-conditions.cmsIndex', compact('getUserCmsData', 'getbuisnessCmsData'));
    }


    public function cmsIndexData(Request $request)
    {
        $getBusinessCmsData = $this->cmsRepository->getCmsData(2);
        return view('recruiter.cms.index', compact('getBusinessCmsData'));
    }

    public function registerPrivacyPolicy(Request $request)
    {
        $getBusinessCmsData = $this->cmsRepository->getprivacyCmsData('privacy_policy', 2);
        return view('privacy-policy', compact('getBusinessCmsData'));
    }
}
