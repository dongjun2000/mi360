<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
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
            $model->increment('read');
        });
    }
}
