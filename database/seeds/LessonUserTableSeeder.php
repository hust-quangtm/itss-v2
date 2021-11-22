<?php

use App\Models\UserLesson;
use Illuminate\Database\Seeder;

class LessonUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(UserLesson::class, 20)->create();
    }
}
