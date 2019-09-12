<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * 数据填充 - 用户表
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class, 100)->create();
        $user                    = \App\User::query()->find(1);
        $user->name              = '董俊';
        $user->email             = 'admin@246ha.com';
        $user->email_verified_at = '2019-09-11 01:02:35';
        $user->password          = bcrypt('admin888');
        $user->avatar            = url('/imgs/default/face.jpg');
        $user->save();
    }
}
