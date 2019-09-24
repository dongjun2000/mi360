<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Article extends Model
{
    public $fillable = ['type', 'title', 'pic', 'content', 'intro', 'category_id'];

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
     * 访问器 - 转换数据字段为文字
     *
     * @param $value
     * @return string
     */
    public function getTypeAttribute($value)
    {
        $str = '原创';
        switch ($value) {
            case 1:
                $str = '原创';
                break;
            case 2:
                $str = '转载';
                break;
            case 3:
                $str = '翻译';
                break;
        }
        return $str;
    }

    /**
     * 与分类模型一对多关联 - 反向
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
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
     * 与评论模型一对多关联
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'article_id');
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

    /**
     * 热门文章
     *
     * @param null $time
     * @return mixed
     */
    public function hottest($time = null)
    {

        $query = $this->query();

        switch($time) {
            case 'weekly':
                $query->where('created_at', '>', Carbon::now()->subWeek());
                break;
            case 'monthly':
                $query->where('created_at', '>', Carbon::now()->subMonth());
                break;
            case 'day':
                // 日热门
                $query->where('created_at', '>', Carbon::now()->subDay());
                break;
        }

        return $query->with('user')
            ->orderByDesc('id')
            ->show()
            ->hot()
            ->paginate(10);
    }

    /**
     * 最新文章
     *
     * @return mixed
     */
    public function newest()
    {
        return $this->with('user')
            ->orderByDesc('id')
            ->show()
            ->paginate(10);
    }

    /**
     * 推荐文章
     *
     * @return mixed
     */
    public function comment()
    {
        return $this->with('user')
            ->orderByDesc('id')
            ->show()
            ->comment()
            ->paginate(10);
    }
}
