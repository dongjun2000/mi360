<?php

use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * 数据填充 - 文章表
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Article::class, 1000)->create();
    }
}
