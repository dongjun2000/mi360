<?php

namespace App\Events;

use App\Tag;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TagFollow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $tag;

    public $is_follow;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Tag $tag, $is_follow)
    {
        $this->tag = $tag;

        $this->is_follow = $is_follow;
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
