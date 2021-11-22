<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CourseTag;
use Faker\Generator as Faker;

$factory->define(CourseTag::class, function (Faker $faker) {
    return [
        'tag_id' => $faker->numberBetween($min = 1, $max = 20),
        'course_id' => $faker->numberBetween($min = 1, $max = 100)
    ];
});
