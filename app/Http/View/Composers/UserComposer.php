<?php

namespace App\Http\View\Composers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserComposer
{
    protected $user;

    public function __construct(Request $request)
    {
        // 获取路由要请求的用户实例
        $this->user = $request->user;
    }

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        // 判断用户的关注状态
        $followStatus = false;
        if (Auth::check() && Auth::user()->id !== $this->user->id) {
            // 登录用户获取关注状态
            $followStatus = $this->user->isFollow(Auth::user()->id);
        }

        // 获取用户实例，并且统计粉丝和发表的文章数
        $user = User::query()->withCount('fans', 'articles')->find($this->user->id);

        $view->with('user', $user)->with('followStatus', $followStatus);
    }
}