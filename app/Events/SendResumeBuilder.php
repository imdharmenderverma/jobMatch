<?php

namespace App\Events;

use App\Models\ResumeBuilderSubscription;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendResumeBuilder
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $resume_format_id;

    public function __construct($user,$resume_format_id)
    {
        
        $this->user = $user;
        $this->resume_format_id = $resume_format_id;

    }
    

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
