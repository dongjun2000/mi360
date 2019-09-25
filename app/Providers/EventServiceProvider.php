<?php

namespace App\Providers;

use App\Events\QuestionAnswer;
use App\Events\UserShow;
use App\Listeners\LoginSuccessUpdateLogtime;
use App\Listeners\UpdateQuestion;
use App\Listeners\UserActivitySubscriber;
use App\Listeners\UserShowUpdateVisitor;
use App\Listeners\UserShowUpdateVisitorTotal;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * 注册订阅者类
     *
     * @var array
     */
    protected $subscribe = [
        UserActivitySubscriber::class,
    ];

    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Login::class => [
            LoginSuccessUpdateLogtime::class,
        ],
        // 查看用户主页
        UserShow::class => [
            // 更新最近访客
            UserShowUpdateVisitor::class,
            // 更新访客总数
            UserShowUpdateVisitorTotal::class,
        ],
        // 回答问题
        QuestionAnswer::class => [
            // 更新问题表冗余字段
            UpdateQuestion::class,
        ],
    ];

    /**
     * 注册应用中的其它事件
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // 定义事件 - 阅读数自增
        Event::listen('article.read', function ($model) {
            $model->timestamps = false;
            $model->increment('read');
        });
    }
}
