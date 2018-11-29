<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

use App\Todo;

class TodoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Todo::truncate();

        $faker = Factory::create();

        for ($i = 0; $i < 50; $i++) {
            Todo::create([
                'todo' => $faker->sentence,
                'due_date' => $faker->dateTime,
            ]);
        }
    }
}
