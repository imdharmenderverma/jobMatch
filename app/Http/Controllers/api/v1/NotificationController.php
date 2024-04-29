<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\FcmTokenRequest;
use App\Models\FcmToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class NotificationController extends Controller
{

    protected $notification = "";
    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }
    public function fcmTokenSave(FcmTokenRequest $request)
    {
        $fcmArray = array(
            'user_id' => auth()->user()->id,
            'fcm_token' => $request->fcm_token,
            'type' => $request->type,
        );
        $getFcmToken = FcmToken::createAndUpdateToken(auth()->user()->id, $fcmArray);
        if ($getFcmToken) {
            return $this->sendResponse(true, $getFcmToken, trans(
                'messages.custom.create_messages',
                ["attribute" => "Fcm Token"]
            ), $this->successStatus);
        } else {
            return $this->sendResponse(false, [], trans(
                'messages.custom.error_messages'
            ), $this->errorStatus);
        }
    }

    public function getNotification()
    {
        $getAllNotification = $this->notification->getAllNotification();
        if ($getAllNotification) {
            return $this->sendResponse(true, $getAllNotification, trans(
                'messages.custom.messages',
                ["attribute" => "notification data"]
            ), $this->successStatus);
        } else {
            return $this->sendResponse(false, [], trans(
                'messages.custom.no_data_found'
            ), $this->errorStatus);
        }
    }
}
