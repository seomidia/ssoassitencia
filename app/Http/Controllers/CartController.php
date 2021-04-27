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
    public function index(Request $request,$product_id)
    {
        $session_id = $_COOKIE["session_key"];

        $exames = DB::table('products as p')
            ->join('categories as c', 'p.category_id','=','c.id')
            ->select(
                'p.*',
                'c.name as categoria'
            )
            ->wherein('p.category_id',[4,5,7,8])
            ->get();

        $colection = collect($exames)
            ->groupBy('categoria')
            ->map(function ($item) {
                return array_merge($item->toArray());
            });

        return view('cart',['prod_id' => $product_id,'produtos' => $colection]);
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
        return redirect('/carrinho/' .  $product_id);
    }
    static function addficha($product_ids)
    {
        $session_id = $_COOKIE["session_key"];
        $existe = Cart::CheckCart($session_id,$product_ids);

        $limpaCart = DB::table('cart_products')
            ->where('session_id',$session_id)
            ->delete();

        if($existe == 0){
            foreach ( $product_ids as $item) {
                DB::table('cart_products')->insert([
                    'session_id' => $session_id,
                    'product_id' => $item,
                    'qtd' => 1
                ]);
            }
        }
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
