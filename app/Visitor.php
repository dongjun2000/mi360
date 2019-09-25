<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    public $fillable = ['user_id', 'visitor', 'visitor_info'];

    /**
     * 定义类型转换
     *
     * @var array
     */
    protected $casts = [
        'visitor_info' => 'array'
    ];
}
