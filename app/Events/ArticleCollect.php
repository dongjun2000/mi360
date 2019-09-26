<?php

namespace App\Events;

use App\Article;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ArticleCollect
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $article;

    public $is_collect;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Article $article, $is_collect = true)
    {
        $this->article = $article;

        $this->is_collect = $is_collect;
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
