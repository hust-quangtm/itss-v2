<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Course;
use Faker\Generator as Faker;
use Illuminate\Http\UploadedFile;

$factory->define(Course::class, function (Faker $faker) {
    return [
        'course_name' => $faker->text(20),
        'description' => $faker->text(200),
        'image'  => 'html_css.png',
        'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100000),
        'teacher_id' => $faker->numberBetween($min = 1, $max = 80)
    ];
});
