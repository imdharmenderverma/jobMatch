<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'recruiter_id',
        'app_user_id',
        'job_id',
        'short_message',
        'message',
        'notification_type',
        'mark_read',
        'mark_as_complete',

    ];


    public function getAllNotification()
    {
        return Notification::where('app_user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->get();
    }
}
