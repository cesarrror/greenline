<?php

use Illuminate\Database\Seeder;
use App\User;
use \Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $faker = Faker::create();

        for($i = 0; $i < 100; $i++){
            User::create([
                'first_name' => $faker->firstName, 
                'last_name' => $faker->lastName,
                'email' => $faker->email,
                'password' => bcrypt('Temporal001'),
                'celphone' => $faker->phoneNumber,
                'user' => $faker->userName,
                'role_id' => $faker->numberBetween($min = 1, $max = 4),
                'active' => true,
                'avatar' => $faker->imageURL($width = 640, $height = 480)
            ]);
        }
    }
}
