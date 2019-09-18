<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Answer;
use Faker\Generator as Faker;

$factory->define(Answer::class, function (Faker $faker) {
    $users = \App\User::query()->pluck('id');
    $questions = \App\Question::query()->pluck('id');
    return [
        'accept' => $faker->boolean,
        'user_id' => $faker->randomElement($users),
        'question_id' => $faker->randomElement($questions),
        'content' => $faker->text(500),
    ];
});
