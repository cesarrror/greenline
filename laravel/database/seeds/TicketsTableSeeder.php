<?php

use Illuminate\Database\Seeder;
use App\Tickets;
use App\Sales;
use App\Products;

class TicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sales = Sales::all();
        $max_productos = Products::select()->count();
        foreach($sales as $sale){
            $ticket = $sale['ticket'];
            $limit = rand(1,10);
            for($i = 0; $i < $limit; $i++){
                $producto_id = rand(1,$max_productos);
                $producto = Products::find($producto_id)->only('price');
                Tickets::create([
                    'ticket_id' => $ticket,
                    'product_id' => $producto_id,
                    'price' => $producto['price']
                ]);
            }
        }
    }
}
