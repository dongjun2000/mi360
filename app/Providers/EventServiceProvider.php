<?php

namespace App\Providers;

use App\Events\UserShow;
use App\Listeners\HandleCountSubscriber;
use App\Listeners\LoginSuccessUpdateLogtime;
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
        // 用户活动记录
        UserActivitySubscriber::class,
        // 处理冗余统计数据
        HandleCountSubscriber::class,
    ];

    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class     => [
            SendEmailVerificationNotification::class,
        ],
        Login::class          => [
            // 登录成功后更新登录时间
            LoginSuccessUpdateLogtime::class,
        ],
        // 查看用户主页
        UserShow::class       => [
            // 更新最近访客
            UserShowUpdateVisitor::class,
            // 更新访客总数
            UserShowUpdateVisitorTotal::class,
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
