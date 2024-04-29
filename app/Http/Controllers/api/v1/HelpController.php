<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\HelpRequest;
use App\Http\Requests\UserHelpStoreRequest;
use App\Interfaces\HelpRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class HelpController extends Controller
{
    protected $helpRepository = "";
    public function __construct(HelpRepositoryInterface $helpRepository)
    {
        $this->helpRepository = $helpRepository;
    }

    public function store(HelpRequest $request)
    {
        try {
            $helpData = $this->helpRepository->storeData($request->all());
            return $this->sendResponse(true, $helpData, trans(
                'messages.custom.create_messages',
                ["attribute" => "Help"]
            ), $this->successStatus);
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], trans(
                'messages.custom.error_messages'
            ), $this->errorStatus);
        }
    }

    public function userStore(UserHelpStoreRequest $request)
    {
        try {
            $helpData = $this->helpRepository->storeData($request->all());
            return $this->sendResponse(true, $helpData, trans(
                'messages.custom.create_contact',
                ["attribute" => "Help"]
            ), $this->successStatus);
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], trans(
                'messages.custom.error_messages'
            ), $this->errorStatus);
        }
    }
}
