<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Lesson;
use Faker\Generator as Faker;

$factory->define(Lesson::class, function (Faker $faker) {
    return [
        'lesson_name' => $faker->text(30),
        'description' => $faker->text(100),
        'requirement' => $faker->text(100),
        'time' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100),
        'course_id' => $faker->numberBetween($min = 1, $max = 100)
    ];
});
