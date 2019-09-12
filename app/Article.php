<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Article extends Model
{
    public $fillable = ['type', 'title', 'pic', 'content', 'intro'];

    /**
     * 访问器 - 格式化文章创建时间
     *
     * @param $value
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    /**
     * 与用户模型一对多关联-反向
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 与标签模型多对多关联
     *
     * @return $this
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tag')->withTimestamps();
    }

    /**
     * 查询作用域 - 允许显示的
     *
     * @param $query
     * @return mixed
     */
    public function scopeShow($query)
    {
        return $query->where('isshow', true);
    }


    /**
     * 查询作用域 - 热门的
     *
     * @param $query
     * @return mixed
     */
    public function scopeHot($query)
    {
        return $query->where('ishot', true);
    }

    /**
     * 查询作用域 - 推荐的
     *
     * @param $query
     * @return mixed
     */
    public function scopeComment($query)
    {
        return $query->where('iscomment', true);
    }
}
