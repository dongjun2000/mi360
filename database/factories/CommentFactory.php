<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 100),
        'article_id' => $faker->numberBetween(1, 100),
        'content' => $faker->text(100),
    ];
});
