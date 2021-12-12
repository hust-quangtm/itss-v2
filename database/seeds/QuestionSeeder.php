<?php

use Illuminate\Database\Seeder;
use App\Models\Test;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $tests = Test::all();

        foreach($tests as $test)
        {
            foreach(range(1,2) as $index)
            {
                $test->questions()->create([
                    'question_text' => $faker->sentence(4)
                ]);
            }
        }
    }
}
