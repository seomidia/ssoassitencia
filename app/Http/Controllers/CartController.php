<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Product;
use App\Cart;
use DB;

class CartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $session_id = $_COOKIE["session_key"];

        $products = DB::table('cart_products as cp')
                     ->join('products as p','cp.product_id','=','p.id')
                     ->where('cp.session_id',$session_id)
                     ->select('p.id','p.name','p.price','p.sale','cp.qtd')
                     ->get();

        $calc = Cart::Calculo($products);

        return view('cart',['produtos' => $products, 'subtotal' => $calc['subtotal'], 'total' => $calc['total']]);
    }

    public function add(Request $request)
    {
        $product_id = $request->input('product_id');
        $session_id = $_COOKIE["session_key"];
        $existe = Cart::CheckCart($session_id,$product_id);

        if($existe == 0){
            DB::table('cart_products')->insert([
               'session_id' => $session_id,
                'product_id' => $product_id,
                'qtd' => 1
            ]);
        }
        return redirect('/carrinho');
    }

    public function update(Request $request,$id)
    {
        $session_id = $_COOKIE["session_key"];
        $qtd = $request->input('cart_qtd');


       return $updateCard = DB::table('cart_products')
            ->where('session_id',$session_id)
            ->where('product_id',$id)
            ->update(['qtd'=>$qtd]);
    }

    public function destroy($id)
    {
        $session_id = $_COOKIE["session_key"];

        DB::table('cart_products')
            ->where('session_id', '=', $session_id)
            ->where('product_id',$id)
            ->delete();
        return redirect('/carrinho');

    }
}
