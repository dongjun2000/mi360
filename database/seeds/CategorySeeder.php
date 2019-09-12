<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['编程语言', '前端开发', 'JavaScript开发', '小程序开发', '区块链', '人工智能', 'iOS开发', 'Android开发', 'PHP开发', '数据库', '.NET开发', 'Python开发', 'Ruby开发', '开发工具', '云计算', 'Java开发', '搜索', '开放平台', '服务器'];
        foreach($names as $name) {
            \App\Category::create([
                'name' => $name
            ]);
        }
    }
}
