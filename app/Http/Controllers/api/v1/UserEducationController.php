<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\IdRequest;
use App\Interfaces\AppUserRepositoryInterface;
use App\Interfaces\UserCertificateRepositoryInterface;
use App\Interfaces\UserEducationRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserEducationController extends Controller
{
    protected $appUserRepository = "";
    protected $userEducationRepository = "";
    protected $userCertificateRepository = "";

    public function __construct(AppUserRepositoryInterface $appUserRepository, UserEducationRepositoryInterface $userEducationRepository, UserCertificateRepositoryInterface $userCertificateRepository)
    {
        $this->appUserRepository = $appUserRepository;
        $this->userEducationRepository = $userEducationRepository;
        $this->userCertificateRepository = $userCertificateRepository;
    }

    public function store(Request $request)
    {
        $validation = [
            'school' => 'required',
            'study_type' => 'required',
            'degree' => 'required',
            'field_of_study' => 'required',
        ];
        if (isset($request->certificate) && $request->certificate != null) {
            $request['certificate'] = json_decode($request->certificate, true);
            $validation = array_merge($validation, [
                "certificate" => "required|array",
                "certificate.*.name" => "required|string",
                "certificate.*.detail" => "required",
            ]);
        }
        $customMessages = [
            'school.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "School"]
            ),
            'study_type.required' => trans(
                'validation.custom.common_required_select',
                ["attribute" => "Study Type"]
            ),
            'degree.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Degree"]
            ),
            'field_of_study.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Field Of Study"]
            ),
            'certificate.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "certificate"]
            ),
            'certificate.*.name.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Certificate Name"]
            ),
            'certificate.*.detail.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Certificate Detail"]
            ),
        ];
        $validator = Validator::make($request->all(), $validation, $customMessages);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->all()[0], 'success' => false], $this->failedStatus);
        }
        try {
            $reqData = $request->all();
            $id = Auth::user()->id;
            $this->appUserRepository->updateUserWithId($id, ['your_education_detail_screen' => 1]);
            $result = $this->userEducationRepository->store($reqData);
            if (isset($request->certificate) && $request->certificate != null) {
                $save = [];
                foreach ($request->certificate as $key => $value) {
                    $save[$key]['name'] = $value['name'];
                    $save[$key]['detail'] = $value['detail'];
                    if (isset($request->document)) {
                        $save[$key]['document'] = isset($request->document[$key]) ? $request->document[$key] : null;
                    }
                }
                $this->userCertificateRepository->store($result->id, $save);
            }
            return $this->sendResponse(true, [$result], trans(
                'messages.custom.update_messages',
                ["attribute" => "User certificate"]
            ), $this->successStatus);
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], $e->getMessage(), $this->errorStatus);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(IdRequest $request)
    {
        try {
            $data = $this->userEducationRepository->getById($request->id);
            if ($data) {
                $this->userEducationRepository->delete($request->id);
                return $this->sendResponse(true, ['data' => []], trans(
                    'messages.custom.delete_messages',
                    ["attribute" => "Education"]
                ), $this->successStatus);
            } else {
                return $this->sendResponse(false, ['data' => []], trans(
                    'messages.custom.invalid',
                    ["attribute" => "Education"]
                ), $this->errorStatus);
            }
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], $e->getMessage(), $this->errorStatus);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteCertificate(IdRequest $request)
    {
        try {
            $data = $this->userCertificateRepository->getById($request->id);
            if ($data) {
                $this->userCertificateRepository->delete($request->id);
                return $this->sendResponse(true, ['data' => []], trans(
                    'messages.custom.delete_messages',
                    ["attribute" => "Certificate"]
                ), $this->successStatus);
            } else {
                return $this->sendResponse(false, ['data' => []], trans(
                    'messages.custom.invalid',
                    ["attribute" => "Certificate"]
                ), $this->errorStatus);
            }
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], $e->getMessage(), $this->errorStatus);
        }
    }
}
