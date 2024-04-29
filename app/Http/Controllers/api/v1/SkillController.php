<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Interfaces\IndustryRepositoryInterface;
use App\Interfaces\SkillRepositoryInterface;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    protected $skillRepository = "";
    protected $industryRepository = "";
    public function __construct(SkillRepositoryInterface $skillRepository, IndustryRepositoryInterface $industryRepository)
    {
        $this->skillRepository = $skillRepository;
        $this->industryRepository = $industryRepository;
    }

    public function get()
    {
        $data = $this->skillRepository->get();
        return $this->sendResponse(true, $data, trans(
            'validation.get_success'
        ), $this->successStatus);
    }

    public function getIndustry()
    {
        $data = $this->industryRepository->ragisterGetParentChild();
        return $this->sendResponse(true, $data, trans(
            'validation.get_success'
        ), $this->successStatus);
    }

    public function getIndustrySkill(Request $request)
    {
        if (isset($request->industry_id) && $request->industry_id != null) {
            $data = $this->industryRepository->getSkillIndustry($request->industry_id);
            return $this->sendResponse(true, $data, trans(
                'validation.get_success'
            ), $this->successStatus);
        } else {
            return $this->sendResponse(false, [], trans(
                'validation.custom.invalid_id',
                ['attribute' => 'Industry Id']
            ), $this->failedStatus);
        }
    }

    public function getPreviousIndustry()
    {
        $data = $this->industryRepository->getPreviousParentChild();
        return $this->sendResponse(true, $data, trans(
            'validation.get_success'
        ), $this->successStatus);
    }
}
