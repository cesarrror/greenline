<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tickets;
use App\Sales;
use DB;
use Auth;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Tickets::all();
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
            $response = Sales::orderBy('id', 'desc')->orderBy('created_at', 'desc')->skip($offset)->take($limit)->get();
        }else{
            $response = Sales::orderBy('id', 'desc')->orderBy('created_at', 'desc')->where('user_id', Auth::id())->skip($offset)->take($limit)->get();
        }

        // print_r($response);
        foreach($response as $row){
            $row->user_id = $row->user()->get()[0];
        }
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Tickets::create($request->all());
        return response()->json(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Tickets::find($id);
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
        $tickets->update($request->all());
        return $tickets;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tickets::find($id)->delete();
        return 204;
    }
}
