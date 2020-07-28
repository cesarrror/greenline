<?php

use Illuminate\Support\Facades\Route;
use App\Sales;
use App\Products;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function(){
    $pass = Hash::make('Temporal001');
    echo $pass."\n";
    $rehash = '';
    if (Hash::needsRehash($pass))
    {
        $pass = Hash::make($pass);
    }
    echo $pass."\n";
    echo Hash::check('Temporal001', $pass);
});


// Route::get('/test', function(){
//     $sales = Sales::all();
//     $max_productos = Products::select()->count();
//     foreach($sales as $sale){
//         $ticket = $sale['ticket'];
//         $limit = rand(1,10);
//         for($i = 0; $i < $limit; $i++){
//             $producto_id = rand(1,$max_productos);
//             $producto = Products::find($producto_id)->only('price');
//             Tickets::create([
//                 'ticket_id' => $ticket,
//                 'product_id' => $producto_id,
//                 'price' => $producto['price']
//             ]);
//         }
//     }
// });