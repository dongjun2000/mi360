<?php

namespace App\Http\Controllers;

use App\User;

class FollowController extends Controller
{

    /**
     * 我的粉丝列表
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function fans(User $user)
    {
        $tag = 'fans';
        $users = $user->fans()->paginate(10);

        return view('follows.fans', compact('tag', 'users', 'user'));
    }

    /**
     * 我的关注列表
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function follows(User $user)
    {
        $tag = 'follows';
        $users = $user->follows()->paginate(10);
        return view('follows.follows', compact('tag', 'users', 'user'));
    }
}
