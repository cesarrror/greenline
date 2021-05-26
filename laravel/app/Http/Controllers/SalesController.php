<?php

namespace App\Http\Controllers;
use App\Sales;
use App\Products;

use Illuminate\Http\Request;
use DB;
use Auth;
use PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Response;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role_information = Auth::user()->role()->get()->first();
        $role = $role_information->id;
        $role_type = $role_information->description;

        $response = [];
        if($role_type !== 'Sales' || $role !== 3){
            $response = Sales::orderBy('id', 'desc')->orderBy('created_at', 'desc')->get();
        }else{
            $response = Sales::orderBy('id', 'desc')->orderBy('created_at', 'desc')->where('user_id', Auth::id())->get();
        }

        // print_r($response);
        foreach($response as $row){
            $row->user_id = $row->user()->get()[0];
        }
        return $response;
        // return Sales::all();
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
        $sale =  Sales::find($id);
        $sale->user_id = $sale->user()->get()[0];
        $sale->tickets = $sale->ticket()->get();

        foreach($sale->tickets as $product){
            $product->product_id = Products::where('id', $product->product_id)->get()[0];

        }
        
        return $sale;
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

    public function getArticle($id){
        $articles = [
            [ 'article' => '10001', 'description' => 'Gansito', 'price' => '10.0', 'stock' => '25', ],
            [ 'article' => '10002', 'description' => 'Coca-cola 600ml', 'price' => '19.5', 'stock' => '10', ],
            [ 'article' => '10003', 'description' => 'Doritos Incognito', 'price' => '15.5', 'stock' => '50', ],
            [ 'article' => '10004', 'description' => 'Cigarros Marlboro 20', 'price' => '63', 'stock' => '20', ],
            [ 'article' => '10005', 'description' => 'Donitas Bimbo', 'price' => '13', 'stock' => '14', ],
            [ 'article' => '10006', 'description' => 'Fanta 2lt', 'price' => '29', 'stock' => '5', ],
            [ 'article' => '10007', 'description' => 'Colgate', 'price' => '17.5', 'stock' => '10', ],
            [ 'article' => '10008', 'description' => 'Arroz 1kg', 'price' => '25', 'stock' => '17', ],
            [ 'article' => '10009', 'description' => 'Sabritas', 'price' => '17.5', 'stock' => '25', ],
            [ 'article' => '10010', 'description' => 'Crema de champiñon', 'price' => '35', 'stock' => '10', ],
            [ 'article' => '10011', 'description' => 'Sprite 1lt', 'price' => '21', 'stock' => '6', ],
            [ 'article' => '10012', 'description' => 'Lala 1lt', 'price' => '12', 'stock' => '10', ]
        ];
        foreach($articles as $article){
            if($article['article'] == $id){
                return response()->json($article, 200);
            }
        }

        $article = ["message" => "Article Not Found"];
        return response()->json($article, 404);
    }

    public function getTicket(){
        $articulos = [
            ["cantidad" => "2", "descripcion" => "Abrazadera de plastico completa", "importe" => "110"],
            ["cantidad" => "1", "descripcion" => "Empaque check-n para fumigadora", "importe" => "150"],
            ["cantidad" => "1", "descripcion" => "Abrazadera SX9-18 para fumigadora", "importe" => "320"],
            ["cantidad" => "3", "descripcion" => "Brocha de cerda gruesa", "importe" => "175"],
            ["cantidad" => "1", "descripcion" => "Empaque para abrazadora de plastico completa", "importe" => "30"],
        ];

        $total = 0;
        $recibido = 1000;

        $height = 500;
        foreach($articulos as $articulo){
            $total = $total + (int)$articulo['importe'];
            $height += 16;
        }

        $pdfData = [
            "nomEmp" => "Comercializadora Gaytan",
            "descTda" => "Juan Rodriguez Contreras",
            "calleTda" => "Av. Benito Juarez",
            "numTda" => "26",
            "colTda" => "Centro",
            "cdTda" => "Atlacomulco",
            "edoTda" => "EDOMEX",
            "cpTda" => "50480",
            "rfc" => "ROCJ520126N26",
            "numPedido" => "000000000726",
            "Caja" => "2",
            "fecha" => date("d/m/Y h:i:s a"),
            "user" => "César Ortiz",
            "articulos" => $articulos,
            "cant_articulos" => sizeof($articulos),
            "total" => $total,
            "iva" => (($total * 16) / 100),
            "recibido" => $recibido,
            "cambio" => ($recibido - ($total+(($total * 16) / 100))),
            "leyenda" => "¡Gracias por la compra!"
        ];

        $pdf = app('dompdf.wrapper');
        $data = PDF::loadView('pdf', $pdfData)
            ->setPaper(array(0,0,260, $height))
            ->save(storage_path('app\\public\\pdf\\').'archivo.pdf');
        
        $file = File::get(storage_path('app\\public\\pdf\\archivo.pdf'));
        $response = Response::make($file, 200);
        $response->header('Content-Type', 'application/pdf');
        return $response;
    }
}
