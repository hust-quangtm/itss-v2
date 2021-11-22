<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CourseUser;
use Faker\Generator as Faker;

$factory->define(CourseUser::class, function (Faker $faker) {
    $courseId = mt_rand(1, 20);
    $userId = mt_rand(1, 80);
    while ($courseId == $userId) {
        $courseId = mt_rand(1, 20);
    }
    return [
        'user_id' => $userId,
        'course_id' => $courseId
    ];
});
