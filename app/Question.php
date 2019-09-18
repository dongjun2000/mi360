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
}
