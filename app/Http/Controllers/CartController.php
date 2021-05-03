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

        $get_categoria = DB::table('products as p')
            ->join('categories as c','p.category_id','=','c.id')
            ->where('p.id',$product_id)
            ->get();

        if(in_array($get_categoria[0]->id,[3,6])){
            $cat = [3,4,5,6,7,8];
            $tipo = true;
        }else{
            $cat = [4,5,7,8];
            $tipo = false;
        }

        $exames = DB::table('products as p')
            ->join('categories as c', 'p.category_id','=','c.id')
            ->select(
                'p.*',
                'c.name as categoria'
            )
            ->wherein('p.category_id',$cat)
            ->get();

        $colection = collect($exames)
            ->groupBy('categoria')
            ->map(function ($item) {
                return array_merge($item->toArray());
            });

        return view('cart',['prod_id' => $product_id,'produtos' => $colection,'tipo'=>$tipo]);
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
    public function getcart(){
        $session_id = $_COOKIE["session_id"];


        return DB::table('cart_products as cp')
            ->join('products as p','cp.product_id','=','p.id')
            ->join('categories as c','p.category_id','=','c.id')
            ->select('p.price','p.name as product_name','p.description','p.category_id','c.name as categoria')
            ->where('session_id',$session_id)
            ->get();

    }
    static function addficha($product_ids)
    {
        $session_id = $_COOKIE["session_id"];
        if(!is_null($product_ids)){
            if($_COOKIE["prod_consulta"] !=''){
                if(!in_array($_COOKIE["prod_consulta"],$product_ids))
                    $product_ids[] = $_COOKIE["prod_consulta"];
            }


            $limpaCart = DB::table('cart_products')
                ->where('session_id',$session_id)
                ->delete();

            $existe = Cart::CheckCart($session_id,$product_ids);


            if($existe == 0 && !empty($product_ids)){

                foreach ( $product_ids as $item) {
                    DB::table('cart_products')->insert([
                        'session_id' => $session_id,
                        'product_id' => $item,
                        'qtd' => 1
                    ]);
                }
            }
        }else{
            $limpaCart = DB::table('cart_products')
                ->where('session_id',$session_id)
                ->delete();
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
