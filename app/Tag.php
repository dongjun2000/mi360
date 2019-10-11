<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $fillable = ['name'];

    public function getLabel($value)
    {
        $str = '';
        switch ($value) {
            case('show'):
                $str = '标签动态';
                break;
            case('info'):
                $str = '标签百科';
                break;
            case('questions'):
                $str = '相关问答';
                break;
            case('article'):
                $str = '相关文章';
                break;
        }
        return $str;
    }


    /**
     * 与文章模型多对多关联
     *
     * @return $this
     */
    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_tag')->withTimestamps();
    }

    /**
     * 与问题模型多对多关联
     *
     * @return $this
     */
    public function questions()
    {
        return $this->belongsToMany(Question::class, 'question_tag')->withTimestamps();
    }

    /**
     * 关注标签的用户
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function concerns()
    {
        return $this->morphToMany(User::class, 'concern')->withTimestamps();
    }

    /**
     * 判断用户是否关注该标签
     *
     * @param $user_id
     * @return bool
     */
    public function isConcern($user_id)
    {
        return $this->concerns()->wherePivot('user_id', $user_id)->exists();
    }
}
