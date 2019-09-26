<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * 定义转换为日期格式的属性
     *
     * @var array
     */
    protected $dates = [
        'logtime',
    ];

    /**
     * 多对多自关联 - 我的关注
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'fans', 'follow')->withTimestamps();
    }

    /**
     * 多对多自关联 - 我的粉丝
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function fans()
    {
        // 我的粉丝按照关注时间倒序
        return $this->belongsToMany(User::class, 'follows', 'follow', 'fans')->withTimestamps();
    }

    /**
     * 关注与取关
     *
     * @param $ids int|array 粉丝用户id
     * @return array
     */
    public function followToggle($ids)
    {
        $ids = is_array($ids) ?: [$ids];
        return $this->fans()->toggle($ids);
    }

    /**
     * 查询指定用户是否是我的粉丝
     *
     * @param $user_id int 粉丝用户id
     * @return mixed
     */
    public function isFollow($user_id)
    {
        return $this->fans()->wherePivot('fans', $user_id)->first();
    }

    /**
     * 与文章模型一对多关联
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany(Article::class, 'user_id');
    }

    /**
     * 与问答模型一对多关联
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany(Question::class, 'user_id');
    }

    /**
     * 与回答模型一对多关联
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany(Answer::class, 'user_id');
    }

    /**
     * 与评论模型一对多关联
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    /**
     * 与个人动态模型一对多关联
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activities()
    {
        return $this->hasMany(Activity::class, 'user_id');
    }

    public function zans()
    {
        return $this->morphedByMany(Article::class, 'zan')->withTimestamps();
    }
}
