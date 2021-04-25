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


}
