<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Question;
use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {
    $ids = \App\User::query()->pluck('id');
    return [
        'user_id'            => ($user_id = $faker->randomElement($ids)),
        'title'              => $faker->text(50),
        'content'            => $faker->text(2000),
        'follow'             => $faker->numberBetween(0, 100),
        'hot'                => $faker->boolean,
        'laster_answer_user' => [
            'id'         => $user_id,
            'name'       => \App\User::query()->where('id', $user_id)->pluck('name')[0],
            'created_at' => $faker->date('Y-m-d H:i:s'),
            'type'      => 0,
        ],
    ];
});
