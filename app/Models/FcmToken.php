<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class FcmToken extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guard = 'fcm_tokens';
    protected $guarded = ['id'];

    public static function checkToken($fcmToken)
    {
        $query = FcmToken::where('fcm_token', $fcmToken)->delete();
        return $query;
    }

    public static function createAndUpdateToken($userId, $fcmToken)
    {

        $query = FcmToken::updateOrCreate(array('user_id' => $userId),  $fcmToken);
        return $query;
    }

    public static function getFcmToken($userId)
    {
        $query = FcmToken::where('user_id', $userId)->first();
        return $query;
    }
}
