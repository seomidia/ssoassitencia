<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use \DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return view('vendor.voyager.produtos.produtos');
    }
    public function Single($slug){
        $produto = DB::table('products')
            ->where('slug',$slug)
            ->get();
        return view('product.single');
    }
    public function category($slug){

        $cat = DB::table('categories as c')
            ->join('products as p','c.id','=','p.category_id')
            ->select('c.name as categoria','p.*')
            ->where('c.slug',$slug)
            ->get();

        $colection = collect($cat)
            ->groupBy('categoria')
            ->map(function ($item) {
                return array_merge($item->toArray());
            });

        return view('category',['produtos'=>$colection]);
    }

    public function search(Request $request){
        $s = $request->input('s');
        $cat = DB::table('categories as c')
            ->join('products as p','c.id','=','p.category_id')
            ->select('c.name as categoria','p.*')
            ->where('p.slug','like','%' . $s . '%')
            ->get();

        $colection = collect($cat)
            ->groupBy('categoria')
            ->map(function ($item) {
                return array_merge($item->toArray());
            });


        return view('busca',['produtos' => $colection,'buscar' => $s]);
    }

    public function getproduto(Request $request){
        $ids = $request->id;


        if($_COOKIE["prod_consulta"] != '' && !is_null($ids)){
            if(!in_array($_COOKIE["prod_consulta"],$ids))
                $ids[] = $_COOKIE["prod_consulta"];
        }


        if(!is_null($ids)){

        \App\Http\Controllers\CartController::addficha($ids);

        return DB::table('products as p')
            ->join('categories as c','p.category_id','=','c.id')
            ->select('p.price','p.name as product_name','p.description','p.category_id','c.name as categoria')
            ->wherein('p.id',$ids)
            ->get();
        }else{
            $session_id = $_COOKIE["session_id"];

            $limpaCart = DB::table('cart_products')
                ->where('session_id',$session_id)
                ->delete();

        }

    }

    public function getservico($id){

        return DB::table('products as p')
            ->where('category_id',$id)
            ->get();
    }
}
