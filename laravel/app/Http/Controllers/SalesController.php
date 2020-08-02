<?php

namespace App\Http\Controllers;
use App\Sales;

use Illuminate\Http\Request;
use DB;
use Auth;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Sales::all();
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

        if($role_type !== 'Sales' || $role !== 3){
            return Sales::orderBy('id', 'desc')->orderBy('created_at', 'desc')->skip($offset)->take($limit)->get();
        }else{
            return Sales::orderBy('id', 'desc')->orderBy('created_at', 'desc')->where('user_id', Auth::id())->skip($offset)->take($limit)->get();
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
        $ticket = $this->new_ticket();
        $uid = Auth::id();
        $ticket = Sales::create(['ticket' => $ticket, 'user_id' => $uid]);
        return response()->json($ticket, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Sales::find($id);
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
        $sales = Sales::update($request->all())->where('id', $id);
        return response()->json($sales, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sales::find($id)->delete();
        return 204;
    }

    /**
     * Generate new Ticket Serial Number.
     *
     * @return string $ticket
     */
    public static function new_ticket()
    {
        $last = DB::table('sales')->max('ticket');

        $date = date('ym');
        if($last === null){
            $last = $date.'0001';
        }else{
            $last_date = substr($last, 0, 4);
            $last = substr($last, 4);
            $last = ((int)$last + 1);
            $zeros = (4 - strlen($last));   

            for($i = 0; $i < $zeros; $i++){
                $last = "0".$last;
            }
            
            if($last_date !== $date){
                $last = $date."0001";
            }else{
                $last = $date.$last;
            }
        }
        return $last;
    }


}
