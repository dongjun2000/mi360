<?php

namespace App\Http\View\Composers;

use App\Visitor;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VisitorComposer
{
    protected $user;

    public function __construct(Request $request)
    {
        $this->user = $request->user;
    }

    public function compose(View $view)
    {
        // 统计每天访问量
        $todayCount = Visitor::query()
            ->where('user_id', $this->user->id)
            ->whereDate('created_at', date('Y-m-d'))
            ->count();

        // 显示最近的9条访问记录
        $visitors = Visitor::query()->where('user_id', $this->user->id)->limit(9)->orderByDesc('updated_at')->get();

        $view->with('visitors', $visitors)->with('todayCount', $todayCount);
    }
}