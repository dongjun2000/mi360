<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User();
        $user->name = '董俊';
        $user->email = 'admin@246ha.com';
        $user->email_verified_at = '2019-09-11 01:02:35';
        $user->password = bcrypt('admin888');
        $user->save();
    }
}
