<?php

namespace App\Events;

use App\UserTest;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TestCompleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var \App\UserTest  $userTest
     */
    public $userTest;
    
    /**
     * Create a new event instance.
     *
     * @param \App\UserTest  $userTest
     * @return void
     */
    public function __construct(UserTest $userTest)
    {
        $this->userTest = $userTest;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
