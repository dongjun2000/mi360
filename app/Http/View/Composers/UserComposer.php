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

        $navs = $this->setNav($user);

        $view->with('user', $user)
            ->with('followStatus', $followStatus)
            ->with('navs', $navs);
    }

    /**
     * 设置导航选项卡
     *
     * @param $user
     * @return array
     */
    public function setNav($user)
    {
        return [
            'show' => ['title' => '我的主页', 'icon' => 'fa-home'],
            'articles' => ['title' => '我的文章', 'icon' => 'fa-file-text-o', 'num' => $user->articles_count],
            'questions' => ['title'=>'我的提问', 'icon' => 'fa-question-circle-o', 'num' => 0],
            'answers' => ['title' => '我的回答', 'icon' => 'fa-thumbs-o-up', 'num' => 0],
            'follows' => ['title' => '我的关注', 'icon' => 'fa-eye', 'num' => 0],
            'fans' => ['title' =>'我的粉丝', 'icon' => 'fa-smile-o', 'num' => $user->fans_count],
            'collects' => ['title' => '我的收藏', 'icon' => 'fa-heart-o', 'num' => 0]
        ];
    }
}