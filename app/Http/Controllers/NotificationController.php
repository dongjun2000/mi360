<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified');
    }

    /**
     * 已读/未读 消息通知列表
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $filter = $request->get('filter');

        if ($filter === 'unread') {
            $notifications = Auth::user()->unreadNotifications;
            // 将未读消息设置为已读
            $notifications->markAsRead();
            // 将未读消息清零
            $user             = Auth::user();
            $user->timestamps = false;
            $user->inform     = 0;
            $user->save();
        } else {
            $notifications = Auth::user()->notifications()->paginate(20);
        }

        return view('notifications.index', compact('notifications', 'filter'));
    }
}
