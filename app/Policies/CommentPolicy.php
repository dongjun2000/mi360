<?php

namespace App\Policies;

use App\Comment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * 删除评论
     *
     * @param User $user
     * @param Comment $comment
     * @return bool
     */
    public function delete(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id && $user->hasVerifiedEmail();
    }

    /**
     * 更新评论
     *
     * @param User $user
     * @param Comment $comment
     * @return bool
     */
    public function update(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id;
    }
}
