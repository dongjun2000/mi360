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
        $users = $user->fans()->paginate(1);

        return view('follows.fans', compact('tag', 'users', 'user'));
    }

    public function follows(User $user)
    {

    }
}
