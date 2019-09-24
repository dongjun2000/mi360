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
        $categories = [
            ['name' => '编程语言', 'icon' => 'fa-code'],
            ['name' => '前端开发', 'icon' => 'fa-html5'],
            ['name' => 'JavaScript', 'icon' => 'fa-code'],
            ['name' => '小程序开发', 'icon' => 'fa-weixin'],
            ['name' => '区块链', 'icon' => 'fa-chain'],
            ['name' => '人工智能', 'icon' => 'fa-cog'],
            ['name' => 'iOS开发', 'icon' => 'fa-apple'],
            ['name' => 'Android开发', 'icon' => 'fa-android'],
            ['name' => 'PHP开发', 'icon' => 'fa-wordpress'],
            ['name' => '数据库', 'icon' => 'fa-database'],
            ['name' => '.NET开发', 'icon' => 'fa-windows'],
            ['name' => 'Python开发', 'icon' => 'fa-code'],
            ['name' => 'Ruby开发', 'icon' => 'fa-code'],
            ['name' => '开发工具', 'icon' => 'fa-legal'],
            ['name' => '云计算', 'icon' => 'fa-skyatlas'],
            ['name' => 'Java开发', 'icon' => 'fa-code'],
            ['name' => '搜索', 'icon' => 'fa-search'],
            ['name' => '开放平台', 'icon' => 'fa-qq'],
            ['name' => '服务器', 'icon' => 'fa-linux']
        ];
        foreach ($categories as $category) {
            \App\Category::create([
                'name' => $category['name'],
                'icon' => $category['icon'],
            ]);
        }
    }
}
