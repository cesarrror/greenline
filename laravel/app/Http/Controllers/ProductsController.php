<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth; 
use App\Products;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Products::all();
    }

    /**
     * Display a listing of the resource per page.
     *
     * @return \Illuminate\Http\Response
     */
    public function page($page)
    {
        $role_information = Auth::user()->role()->get()->first();
        
        $role = $role_information->id;
        $role_type = $role_information->description;

        $offset = ( $page - 1 ) * 10;
        $limit = $page * 10;

        $response = [];
        if($role_type !== 'Sales' || $role !== 3){
            $response = Products::orderBy('id', 'desc')->orderBy('created_at', 'desc')->skip($offset)->take($limit)->get();
            return $response;
        }else{
            $response = ["message"=>"Unauthorized, You can\'t access to this section!"];
            return response()->json($response, 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Products::create($request->all());
        return response()->json(null,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Products::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $products->update($request->all());
        return $products;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Products::find($id)->delete();
        return 204;
    }
}
