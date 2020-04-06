<?php

namespace App\Events\Telematic;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ResponseStreamUser implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $user_id_emisor;
    public $user_id_receptor;
    public $stream;

    public function __construct($user_id_emisor, $user_id_receptor, $stream)
    {
        $this->user_id_emisor = $user_id_emisor;
        $this->user_id_receptor = $user_id_receptor;
        $this->stream = $stream;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('ResponseStreamUserChannel-'.$this->user_id_receptor);
    }
}
