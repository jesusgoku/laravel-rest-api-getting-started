<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $faker = Factory::create();
        $password = Hash::make('12345678');

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => $password,
        ]);

        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => $password,
            ]);
        }
    }
}
