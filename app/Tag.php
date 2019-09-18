<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $fillable = ['name'];

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
}
