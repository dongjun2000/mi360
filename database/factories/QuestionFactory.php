<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Question;
use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {
    $ids = \App\User::query()->pluck('id');
    return [
        'user_id'            => $faker->randomElement($ids),
        'title'              => $faker->text(50),
        'content'            => $faker->text(2000),
        'follow'             => $faker->numberBetween(0, 100),
        'answer'             => ($answer = $faker->numberBetween(0, 100)),
        'read'               => $faker->numberBetween(0, 100),
        'status'             => $answer === 0 ? 0 : $faker->numberBetween(1, 2),
        'hot'                => $faker->boolean,
        'laster_answer_user' => [
            'id'         => ($current_id = $faker->randomElement($ids)),
            'name'       => \App\User::query()->where('id', $current_id)->pluck('name')[0],
            'created_at' => $faker->time()
        ],
    ];
});
