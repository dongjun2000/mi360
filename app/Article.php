<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public $fillable = ['type', 'title', 'pic', 'content', 'intro'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tag')->withTimestamps();
    }
}
