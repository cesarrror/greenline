<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Users;
use App\Sales;
use App\Tickets;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['prefix' => 'auth'], function(){

    /****    O A U T H    ****/
    Route::post('/login', 'AuthController@login');
    
});


Route::middleware('auth:api')->group(function(){

    /****    O A U T H    ****/
    Route::get('/logout', 'AuthController@logout');
    
    /****   U S E R S   ****/
    Route::get('/users', 'UsersController@index');
    Route::post('/users', 'UsersController@store');
    Route::get('/users/info', 'AuthController@user');
    Route::get('/users/{id}', 'UsersController@show');
    Route::get('/users/{id}/sales', 'UsersController@sales');
    Route::put('/users/{id}', 'UsersController@update');
    Route::delete('/users/{id}', 'UsersController@destroy');
    
    /****   T I C K E T S   ****/
    Route::get('/tickets', 'TicketsController@index');
    Route::post('/tickets', 'TicketsController@store');
    Route::get('/tickets/{id}', 'TicketsController@show');
    Route::put('/tickets/{id}', 'TicketsController@update');
    Route::delete('/tickets/{id}', 'TicketsController@destroy');
    
    /****   S A L E S   ****/
    Route::get('/sales', 'SalesController@index');
    Route::post('/sales', 'SalesController@store');
    Route::get('/sales/page/{page}', 'SalesController@page');
    Route::get('/sales/{id}', 'SalesController@show');
    Route::put('/sales/{id}', 'SalesController@update');
    Route::delete('/sales/{id}', 'SalesController@destroy');


});
