<?php

namespace App\Http\Controllers;

use App\Cart;
use DB;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $session_id = $_COOKIE["session_key"];

        $products = DB::table('order_products')
            ->join('products','order_products.product_id','=','products.id')
            ->where('order_products.session_id',$session_id)
            ->select('products.id','products.name','products.price','products.sale','order_products.qtd')
            ->get();

        $calc = Cart::Calculo($products);

        return view('checkout',['produtos' => $products, 'subtotal' => $calc['subtotal'], 'total' => $calc['total']]);

    }

    public function Autocomplete(Request $request)
    {
        $search = $request->input('search');
        $result = DB::table('companies')
            ->where('nome_fantasia', 'like', '%'. $search .'%')
            ->get();

        $companies = [];
        if(count($result)){
            foreach ($result as $item) {
                $companies[] = array("success"=>true, "value"=>$item->id,"label"=>$item->nome_fantasia);
            }
        }else{
            $companies[] = array("success"=>false, "value"=> '',"label"=> '');
        }

        return response()->json($companies);
    }
}
