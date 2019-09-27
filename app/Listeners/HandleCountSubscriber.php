<?php

namespace App\Listeners;

use App\Answer;
use App\Article;
use App\Question;
use App\Events\UserFollow;
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
        // 用户关注与取关
        UserFollow::class                => [
            // 更新用户的关注数
            'onUserFollowTotal',
            // 更新用户的粉丝数
            'onUserFanTotal',
        ],
        'eloquent.created: App\Article'  => 'onUserArticleTotal',
        'eloquent.created: App\Question' => 'onUserQuestionTotal',
        'eloquent.created: App\Answer'   => [
            // 更新用户的回答总数
            'onUserAnswerTotal',
            // 更新问题的回答总数
            'onQuestionAnswerTotal',
        ]
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

    public function onUserFollowTotal($event)
    {
        //User $follow, User $fan, $is_follow

        $user             = $event->follow;
        $user->timestamps = false;
        $event->is_follow ? $user->increment('fan') : $user->decrement('fan');
    }

    public function onUserFanTotal($event)
    {
        $user = $event->fan;
        $user->timestamps = false;
        $event->is_follow ? $user->increment('follow') : $user->decrement('follow');
    }

    public function onQuestionAnswerTotal(Answer $answer)
    {
        $question                     = $answer->question;
        $question->timestamps         = false;
        $question->answer             += 1;
        $question->laster_answer_user = [
            'id'         => \Auth::user()->id,
            'name'       => \Auth::user()->name,
            'type'       => 1,
            'created_at' => now()
        ];
        $question->save();
    }

    public function onUserAnswerTotal(Answer $answer)
    {
        $user             = $answer->user;
        $user->timestamps = false;
        $user->increment('answer');
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
