<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $fillable = ['article_id', 'content', 'pid', 'reply_user_id'];

    /**
     * 与文章模型一对多关联 - 反向
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }

    /**
     * 与用户模型一对多关联 - 反向
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * 与用户模型一对多关联 - 反向
     *
     * 回复用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reply_user()
    {
        return $this->belongsTo(User::class, 'reply_user_id');
    }

    /**
     * 一对多自关联 - 获取评论的子评论
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reply()
    {
        return $this->hasMany(Comment::class, 'pid');
    }
}
