<?php

namespace App\Listeners;

use App\Visitor;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserShowUpdateVisitor
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
     * @param  object $event
     * @return void
     */
    public function handle($event)
    {
        if (\Auth::check()) {
            $user = \Auth::user();
            if ($user->id !== $event->user->id) {   // 登录用户访问自己的主页浏览量不增加
                Visitor::updateOrCreate(
                    [
                        'user_id' => $event->user->id,
                        'visitor' => $user->id,
                    ],
                    [
                        'visitor_info' => [
                            'avatar' => $user->avatar,
                            'name'   => $user->name,
                        ]
                    ]
                );
            }
        }
    }
}
