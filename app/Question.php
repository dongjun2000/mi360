<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public $fillable = ['title', 'content', 'laster_answer_user'];

    /**
     * 定义性类型转换
     *
     * @var array
     */
    protected $casts = [
        'laster_answer_user' => 'array'
    ];

    /**
     * 访问器 - 格式化提问时间
     *
     * @param $value
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    /**
     * 与标签模型多对多关联
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'question_tag', 'question_id', 'tag_id');
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
     * 与回答模型一对多关联
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany(Answer::class, 'question_id');
    }

    /**
     * 获取收藏问答的所有用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function collects()
    {
        return $this->morphToMany(User::class, 'collect')->withTimestamps();
    }

    /**
     * 判断用户是否收藏该问答
     *
     * @param $user_id
     * @return bool
     */
    public function isCollect($user_id)
    {
        return $this->collects()->wherePivot('user_id', $user_id)->exists();
    }

    /**
     * 关注问答的用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function concerns()
    {
        return $this->morphToMany(User::class, 'concern')->withTimestamps();
    }

    /**
     * 判断用户是否关注该问答
     *
     * @param $user_id
     * @return bool
     */
    public function isConcern($user_id)
    {
        return $this->concerns()->wherePivot('user_id', $user_id)->exists();
    }
}
