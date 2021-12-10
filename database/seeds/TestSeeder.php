<?php

use Illuminate\Database\Seeder;
use App\Models\Test;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach(range(1,5) as $id)
        {
            Test::insert([
                'course_id' => '1',
                'id' => $id,
                'test_name' => $faker->sentence(3)
            ]);
        }
    }
}
