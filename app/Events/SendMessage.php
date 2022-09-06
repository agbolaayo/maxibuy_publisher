<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $msg;
    public $channell;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($msg,$channell)
    {
        $this->msg = $msg;
        $this->channell = $channell;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('channel-name');
        return new channel($this->channell);
    }

    public function broadcastAs(){
        return 'Subscriber';
    }

    public function broadcastWith()
    {
        return [
            'topic' => $this->channell,
            'data' => json_decode($this->msg,true),
        ];
    }
}