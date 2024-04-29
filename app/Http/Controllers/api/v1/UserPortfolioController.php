<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\IdRequest;
use App\Interfaces\AppUserRepositoryInterface;
use App\Interfaces\UserPortfolioRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserPortfolioController extends Controller
{
    protected $appUserRepository = "";
    protected $userPortfolioRepository = "";
    public function __construct(AppUserRepositoryInterface $appUserRepository, UserPortfolioRepositoryInterface $userPortfolioRepository)
    {
        $this->appUserRepository = $appUserRepository;
        $this->userPortfolioRepository = $userPortfolioRepository;
    }

    public function store(Request $request)
    {

        $validation = [
            'tick_box' => 'required',
            'company' => 'required_if:tick_box,==,0',
            'industry' => 'required_if:tick_box,==,0',
            'title' => 'required_if:tick_box,==,0',
            'job_duties' => 'required_if:tick_box,==,0',
        ];
        if (isset($request->portfolio) && $request->portfolio != null) {
            $request['portfolio'] = json_decode($request->portfolio, true);
            $validation = array_merge($validation, [
                "portfolio" => "required|array",
                "portfolio.*.title" => "required|string",
                "portfolio.*.description" => "required",
                "portfolio.*.start_date" => "required",
                "portfolio.*.end_date" => "required",
            ]);
        }
        $customMessages = [
            'company.required_if' => trans(
                'validation.custom.common_required',
                ["attribute" => "Company"]
            ),
            'industry.required_if' => trans(
                'validation.custom.common_required_select',
                ["attribute" => "Industry"]
            ),
            'title.required_if' => trans(
                'validation.custom.common_required',
                ["attribute" => "Title"]
            ),
            'job_duties.required_if' => trans(
                'validation.custom.common_required',
                ["attribute" => "Job Duties"]
            ),
            'portfolio.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Portfolio"]
            ),
            'portfolio.*.title.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Project Title"]
            ),
            'portfolio.*.description.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Project Description"]
            ),
            'portfolio.*.start_date.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Start date"]
            ),
            'portfolio.*.end_date.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "End date"]
            ),
        ];
        $validator = Validator::make($request->all(), $validation, $customMessages);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->all()[0], 'success' => false], $this->errorStatus);
        }

        $reqData = $request->all();
        $id = Auth::user()->id;
        $this->appUserRepository->updateUserWithId($id, ['your_previous_experience_screen' => 1]);
        if ($request->id) {
            $updatePreviousExperience = [
                'company' => $request->company,
                'industry' => $request->industry,
                'title' => $request->title,
                'job_duties' => $request->job_duties,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            ];

            $result = $this->appUserRepository->updatePreviousExperience($request->id, $updatePreviousExperience);
        } else {
            $result = $this->appUserRepository->savePreviousExperience($id, $reqData);
        }
        if (isset($request->portfolio) && $request->portfolio != null) {
            $this->userPortfolioRepository->store($result->id, $request->portfolio);
        }
        return $this->sendResponse(true, [$result], trans(
            'messages.custom.update_messages',
            ["attribute" => "User Portfolio"]
        ), $this->successStatus);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(IdRequest $request)
    {
        try {
            $data = $this->appUserRepository->getPreviousExperienceById($request->id);
            if ($data) {
                $this->appUserRepository->deletePreviousExperience($request->id);
                return $this->sendResponse(true, ['data' => []], trans(
                    'messages.custom.delete_messages',
                    ["attribute" => "Previous Experience"]
                ), $this->successStatus);
            } else {
                return $this->sendResponse(false, ['data' => []], trans(
                    'messages.custom.invalid',
                    ["attribute" => "Previous Experience"]
                ), $this->errorStatus);
            }
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], $e->getMessage(), $this->errorStatus);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletePortfolio(IdRequest $request)
    {
        try {
            $data = $this->userPortfolioRepository->getById($request->id);
            if ($data) {
                $this->userPortfolioRepository->delete($request->id);
                return $this->sendResponse(true, ['data' => []], trans(
                    'messages.custom.delete_messages',
                    ["attribute" => "Portfolio"]
                ), $this->successStatus);
            } else {
                return $this->sendResponse(false, ['data' => []], trans(
                    'messages.custom.invalid',
                    ["attribute" => "Portfolio"]
                ), $this->errorStatus);
            }
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], $e->getMessage(), $this->errorStatus);
        }
    }
}
