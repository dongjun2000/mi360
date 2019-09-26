<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ArticleZanTotal
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $article = $event->article;
        $article->timestamps = false;
        // 赞或取消点赞
        $event->is_zan ? $article->increment('zan') : $article->decrement('zan') ;
    }
}
