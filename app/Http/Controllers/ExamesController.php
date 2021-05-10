<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class ExamesController extends Controller
{

    public function index(){
        $exames = \DB::table('exame as e')
            ->join('orders as os','e.order_id','=','os.id')
            ->join('products as p','e.product_id','=','p.id')
            ->select('*')
            ->get();

        return view('exames.listagem',['exames'=>$exames]);
    }
}
