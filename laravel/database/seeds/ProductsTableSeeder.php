<?php

use Illuminate\Database\Seeder;
use App\Products;
use \Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Products::truncate();
        $faker = Faker::create();
        
        for($i = 0; $i < 2500; $i++){
            Products::create([
                'name' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 300),
                'price_type' => 'Per Unit',
                'available' =>  $faker->boolean,
                'description' => $faker->sentence($nbWords = 30, $variableNbWords = true),
                'rate' => $faker->numberBetween($min = 0, $max = 5),
                'image' => $faker->imageUrl($width = 640, $height = 480)
            ]);
        }
    }
}
