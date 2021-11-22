<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\UserLesson;
use Faker\Generator as Faker;

$factory->define(UserLesson::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween($min = 1, $max = 80),
        'lesson_id' => $faker->numberBetween($min = 1, $max = 20)
    ];
});
