<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserSkillApiRequest;
use App\Interfaces\AppUserRepositoryInterface;
use App\Interfaces\UserSkillRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class UserSkillController extends Controller
{
    protected $userSkillRepository = "";
    protected $appUserRepository = "";
    public function __construct(AppUserRepositoryInterface $appUserRepository, UserSkillRepositoryInterface $userSkillRepository)
    {
        $this->userSkillRepository = $userSkillRepository;
        $this->appUserRepository = $appUserRepository;
    }

    public function get()
    {
        $data = $this->userSkillRepository->get();
        return $this->sendResponse(true, $data, trans(
            'validation.get_success'), $this->successStatus);
    }
    
    public function getSoftSkill()
    {
        $data = $this->userSkillRepository->getSoftSkill();
        return $this->sendResponse(true, $data, trans(
            'validation.get_success'), $this->successStatus);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserSkillApiRequest $request)
    {
        try {
            $id = Auth::user()->id;
            $this->appUserRepository->updateUserWithId($id, ['your_skill_screen' => 1]);
            $this->userSkillRepository->store($request->all());
            $data = $this->userSkillRepository->get();
            return $this->sendResponse(true, $data, trans(
                'messages.custom.create_messages',
                ["attribute" => "User Skill"]
            ), $this->successStatus);
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], trans(
                'messages.custom.error_messages'), $this->errorStatus);
        }
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function storeSoftSkillScreen()
    {
        try {
            $id = Auth::user()->id;
            $this->appUserRepository->updateUserWithId($id, ['soft_skill_screen' => 1]);
            return $this->sendResponse(true,[], trans(
                'messages.custom.update_messages',
                ["attribute" => "Soft Skill Screen"]
            ), $this->successStatus);
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], trans(
                'messages.custom.error_messages'), $this->errorStatus);
        }
    }
}
