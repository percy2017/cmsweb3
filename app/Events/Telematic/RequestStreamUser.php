<?php

namespace App\Events\Telematic;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RequestStreamUser implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $user_emisor;
    public $user_receptor;
    public $stream;

    public function __construct($user_emisor, $user_receptor, $stream)
    {
        $this->user_emisor = $user_emisor;
        $this->user_receptor = $user_receptor;
        $this->stream = $stream;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('RequestStreamUserChannel-'.$this->user_receptor->id);
    }
}
