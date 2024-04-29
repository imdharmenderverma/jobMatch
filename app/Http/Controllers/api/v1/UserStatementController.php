<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStatementRequest;
use App\Interfaces\AppUserRepositoryInterface;
use App\Interfaces\UserStatementRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class UserStatementController extends Controller
{
    protected $userStatementRepository = "";
    protected $appUserRepository = "";
    public function __construct(UserStatementRepositoryInterface $userStatementRepository, AppUserRepositoryInterface $appUserRepository)
    {
        $this->userStatementRepository = $userStatementRepository;
        $this->appUserRepository = $appUserRepository;
    }

   /**
     * Store a newly created resource in storage.
     */
    public function store(UserStatementRequest $request)
    {
        try {
            $userId = Auth::user()->id;
            $this->userStatementRepository->store($request->all());
            $this->appUserRepository->updateUserWithId($userId, ['user_statement_screen' => $request->category_id]);
            return $this->sendResponse(true, $this->userStatementRepository->get($request->category_id), trans(
                'messages.custom.create_messages',
                ["attribute" => "User Statement"]
            ), $this->successStatus);
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], trans(
                'messages.custom.error_messages'), $this->errorStatus);
        }
    }
}
