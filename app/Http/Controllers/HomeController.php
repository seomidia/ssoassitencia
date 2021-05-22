<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $produtos = Product::all();
        $cat = DB::table('categories as c')
            ->join('products as p','c.id','=','p.category_id')
            ->select('c.name as categoria','p.*')
            ->get();

        $colection = collect($cat)
            ->groupBy('categoria')
            ->map(function ($item) {
                return array_merge($item->toArray());
            });


        return view('home',['produtos' => $produtos,'categoria'=> $colection]);
    }

    public function sobrenos()
    {
        $datapage = DB::table('pages')
            ->where('slug','sobre-nos')
            ->get();

        return view('pages',['datapage'=>$datapage]);
    }
    public function politicadeprivacidade()
    {
        $datapage = DB::table('pages')
            ->where('slug','politica-de-privacidade')
            ->get();

        return view('pages',['datapage'=>$datapage]);
    }
    public function parceiros()
    {
        $datapage = DB::table('pages')
            ->where('slug','parceiros')
            ->get();

        return view('pages',['datapage'=>$datapage]);
    }
    public function trabalheconosco()
    {
        return view('trabalheconosco');
    }

}
