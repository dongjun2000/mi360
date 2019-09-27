<?php

namespace App\Listeners;

use App\Article;
use App\Question;
use Auth;
use App\Events\ArticleCollect;
use App\Events\ArticleZan;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class HandleCountSubscriber
 * @package App\Listeners
 */
class HandleCountSubscriber
{

    /**
     * 定义事件及事件处理列表
     *
     * @var array
     */
    protected $listen = [
        // 文章点赞
        ArticleZan::class                => [
            // 更新用户的获赞总数
            'onUserZanTotal',
            // 更新文章的获赞总数
            'onArticleZanTotal',
        ],
        // 文章收藏
        ArticleCollect::class            => [
            // 更新用户的被收藏总数
            'onUserCollectTotal',
            // 更新文章的被收藏总数
            'onArticleCollectTotal',
        ],
        'eloquent.created: App\Article'  => 'onUserArticleTotal',
        'eloquent.created: App\Question' => 'onUserQuestionTotal',
    ];

    /**
     * Handle the event.
     *
     * @param  object $event
     * @return void
     */
    public function subscribe($events)
    {
        foreach ($this->listen as $event => $listener) {
            if (is_array($listener)) {
                foreach ($listener as $item) {
                    $events->listen($event, __CLASS__ . '@' . $item);
                }
            } else {
                $events->listen($event, __CLASS__ . '@' . $listener);
            }
        }
    }

    public function onUserQuestionTotal(Question $question)
    {
        $user             = $question->user;
        $user->timestamps = false;
        $user->increment('question');
    }

    public function onUserArticleTotal(Article $article)
    {
        $user             = $article->user;
        $user->timestamps = false;
        $user->increment('article');
    }

    /**
     * @param $event
     */
    public function onArticleZanTotal($event)
    {
        $article             = $event->article;
        $article->timestamps = false;
        $event->is_zan ? $article->increment('zan') : $article->decrement('zan');
    }

    /**
     * @param $event
     */
    public function onUserZanTotal($event)
    {
        $user             = $event->article->user;
        $user->timestamps = false;
        $event->is_zan ? $user->increment('zan') : $user->decrement('zan');
    }

    /**
     * @param $event
     */
    public function onUserCollectTotal($event)
    {
        $user             = $event->article->user;
        $user->timestamps = false;
        $event->is_collect ? $user->increment('collect') : $user->decrement('collect');
    }

    /**
     * @param $event
     */
    public function onArticleCollectTotal($event)
    {
        $article             = $event->article;
        $article->timestamps = false;
        $event->is_collect ? $article->increment('collect') : $article->decrement('collect');
    }
}
