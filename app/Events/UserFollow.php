<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserFollow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $follow;

    public $fan;

    public $is_follow;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($follow, $fan, $is_follow)
    {
        // 被关注用户
        $this->follow = $follow;

        // 关注用户
        $this->fan = $fan;

        // 是否是关注操作，true是，false否
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
