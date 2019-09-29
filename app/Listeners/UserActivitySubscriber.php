<?php

namespace App\Listeners;

use App\Answer;
use App\Article;
use App\Events\QuestionFollow;
use App\Question;
use App\Activity;
use App\Events\ArticleCollect;
use App\Events\QuestionCollect;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserActivitySubscriber
{
    protected $listen = [
        // 事件名 => '事件操作'
        QuestionFollow::class            => 'onQuestionFollowed',
        QuestionCollect::class           => 'onQuestionCollected',
        ArticleCollect::class            => 'onArticleCollected',
        'eloquent.created: App\Article'  => 'onArticleCreated',
        'eloquent.created: App\Question' => 'onQuestionCreated',
        'eloquent.created: App\Answer'   => 'onAnswerCreated',
    ];

    /**
     * 为订阅者注册监听器
     *
     * @param $events
     */
    public function subscribe($events)
    {
        foreach ($this->listen as $event => $listener) {
            $events->listen($event, __CLASS__ . '@' . $listener);
        }
    }

    /**
     * 问答关注
     *
     * @param $event
     */
    public function onQuestionFollowed($event)
    {
        if ($event->is_follow) {
            $question = $event->question;
            $user     = \Auth::user();
            Activity::create([
                'user_id'      => $user->id,
                'subject_id'   => $question->id,
                'subject_type' => $question->getTable(),
                'description'  => '关注了问答',
                'properties'   => [
                    'event'    => 'question.followed',
                    'user'     => [
                        'name'   => $user->name,
                        'avatar' => $user->avatar,
                    ],
                    'question' => [
                        'title' => $question->title,
                    ],
                ],
            ]);
        }
    }

    /**
     * 问答收藏
     *
     * @param $event
     */
    public function onQuestionCollected($event)
    {
        if ($event->is_collect) {
            $question = $event->question;
            $user     = \Auth::user();

            Activity::create([
                'user_id'      => $user->id,
                'subject_id'   => $question->id,
                'subject_type' => $question->getTable(),
                'description'  => '收藏了问答',
                'properties'   => [
                    'event'    => 'question.collected',
                    'user'     => [
                        'name'   => $user->name,
                        'avatar' => $user->avatar,
                    ],
                    'question' => [
                        'title' => $question->title,
                    ],
                ],
            ]);
        }
    }

    /**
     * 收藏文章动态
     *
     * @param $event
     */
    public function onArticleCollected($event)
    {
        if ($event->is_collect) {
            $article = $event->article;
            $user    = \Auth::user();

            Activity::create([
                'user_id'      => $user->id,
                'subject_id'   => $article->id,
                'subject_type' => $article->getTable(),
                'description'  => '收藏了文章',
                'properties'   => [
                    'event'   => 'article.collected',
                    'user'    => [
                        'name'   => $user->name,
                        'avatar' => $user->avatar,
                    ],
                    'article' => [
                        'title' => $article->title,
                        'intro' => $article->intro,
                        'pic'   => $article->pic,
                    ],
                ],
            ]);
        }
    }

    /**
     * 发表文章动态
     *
     * @param Article $article
     */
    public function onArticleCreated(Article $article)
    {
        Activity::create([
            'user_id'      => $article->user_id,
            'subject_id'   => $article->id,
            'subject_type' => $article->getTable(),
            'description'  => '发布了文章',
            'properties'   => [
                'event'   => 'article.created',
                'user'    => [
                    'name'   => $article->user->name,
                    'avatar' => $article->user->avatar,
                ],
                'article' => [
                    'title' => $article->title,
                    'intro' => $article->intro,
                    'pic'   => $article->pic,
                ]
            ]
        ]);
    }

    /**
     * 发表提问
     *
     * @param Question $question
     */
    public function onQuestionCreated(Question $question)
    {
        Activity::create([
            'user_id'      => $question->user_id,
            'subject_id'   => $question->id,
            'subject_type' => $question->getTable(),
            'description'  => '提出了问题',
            'properties'   => [
                'event'    => 'question.created',
                'user'     => [
                    'name'   => $question->user->name,
                    'avatar' => $question->user->avatar,
                ],
                'question' => [
                    'title' => $question->title,
                ]
            ]
        ]);
    }

    /**
     * 回答问题
     *
     * @param Answer $answer
     */
    public function onAnswerCreated(Answer $answer)
    {
        Activity::create([
            'user_id'      => $answer->user_id,
            'subject_id'   => $answer->id,
            'subject_type' => $answer->getTable(),
            'description'  => '回答了问题',
            'properties'   => [
                'event'    => 'answer.created',
                'user'     => [
                    'name'   => $answer->user->name,
                    'avatar' => $answer->user->avatar,
                ],
                'question' => [
                    'id'    => $answer->question->id,
                    'title' => $answer->question->title,
                ],
                'answer'   => [
                    'content' => $answer->content,
                ]
            ]
        ]);
    }
}
