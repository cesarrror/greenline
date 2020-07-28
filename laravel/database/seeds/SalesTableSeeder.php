<?php

use Illuminate\Database\Seeder;
use App\Sales;
use \Faker\Factory as Faker;
use App\Http\Controllers\SalesController as SalesController;

class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sales::truncate();
        $faker = Faker::create();

        for($i = 0; $i < 250; $i++){
            $ticket = SalesController::new_ticket();
            Sales::create([
                'user_id' => $faker->numberBetween($min = 1, $max = 100),
                'ticket' => $ticket
            ]);
        }
    }
}
