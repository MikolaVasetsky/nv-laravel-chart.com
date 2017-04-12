<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChangeChart implements ShouldBroadcast
{
    use SerializesModels;

    public $chartId;

    public function __construct($id)
    {
        $this->chartId = $id;
    }

    public function broadcastOn()
    {
        return ['charts'];
    }

    public function broadcastAs()
    {
        return 'changeChart';
    }
}