<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    $user_ids     = \App\User::query()->pluck('id');
    return [
        'type'       => $faker->randomElement([1, 2, 3]),
        'category_id' => $faker->numberBetween(1, 19),
        'user_id'    => $faker->randomElement($user_ids),
        'title'      => $faker->text(50),
        'pic'        => $faker->imageUrl(),
        'intro'      => $faker->text(200),
        'content'    => $faker->text(1000),
        'isshow'     => $faker->boolean(),
        'iscomment'  => $faker->boolean(),
        'ishot'      => $faker->boolean(),
    ];
});
