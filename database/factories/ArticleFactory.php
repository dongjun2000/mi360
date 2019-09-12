<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    $ids = \App\User::query()->pluck('id');
    return [
        'type'      => $faker->randomElement([1, 2, 3]),
        'user_id'   => $faker->randomElement($ids),
        'title'     => $faker->text(50),
        'pic'       => $faker->imageUrl(),
        'intro'     => $faker->text(200),
        'content'   => $faker->text(1000),
        'zan'       => $faker->numberBetween(0, 100),
        'read'      => $faker->numberBetween(0, 100),
        'collect'   => $faker->numberBetween(0, 100),
        'isshow'    => $faker->boolean(),
        'iscomment' => $faker->boolean(),
        'ishot'     => $faker->boolean(),
    ];
});
