<?php

namespace App\Helpers;

use App\Models\AppUser;
use App\Models\FcmToken;
use App\Models\Notification;
use Illuminate\Support\Facades\Config;

class NotificationHelper
{
    public static function sendNotification($markAsTrue, $notification, $appUserId, $recruiterId, $appUser = true)
    {
        $insertNotification = array(
            "message" => $notification['message'],
            "app_user_id" => $appUserId,
            "recruiter_id" => $notification['job_id'],
            "job_id" => $recruiterId,
            "short_message" => $notification['title'],
            "mark_as_complete" => $markAsTrue,
        );

        $insertNotification1 =  Notification::create($insertNotification);

        if ($appUser) {
            $NotificationData = array('message' => $notification['message'], 'body' => $notification['message'], 'job_id' => $notification['job_id']);
            $userExist = AppUser::where('id', $appUserId)->first();
            $userData = FcmToken::where('user_id', $userExist->id)->first();
            if ($userExist) {
                if (!empty($userData)) {
                    NotificationHelper::pushToGooglePartTimer(array($userData->fcm_token), $NotificationData);
                }
            }
        }
    }

    public static function pushToGooglePartTimer($arrayAndroidToken, $NotificationData)
    {
        $googleApiKey = Config::get('app.server_api_key');
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array(
            'registration_ids' => $arrayAndroidToken,
            'data' => $NotificationData,
            'priority' => 'high',
            'notification' => $NotificationData,
        );
        $headers = array(
            'Authorization: key=' . $googleApiKey,
            'Content-Type: application/json',
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}
