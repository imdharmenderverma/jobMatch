<?php

namespace App\Interfaces;

interface CmsRepositoryInterface
{
public function getPrivacyPolicyData($type);
public function updatePrivacyPolicyData($request);
public function getTermsOfUseData($type);
public function updateTermsOfUseData($request);
public function getCms($type);
public function updatePrivacyPolicy($type,$request);
public function updateTermsOfUse($type,$request);
public function getCmsData($type);
public function getTermsCmsData($type);
public function getprivacyCmsData($type);
}
