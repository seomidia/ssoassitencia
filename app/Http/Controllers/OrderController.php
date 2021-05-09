<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
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
        return view('/vendor/voyager/orders');
    }
    public function pedidos()
    {
        $order = \DB::table('orders as o')
            ->join('order_products as op','o.id','=','op.order_id')
            ->join('products as p','op.product_id','=','p.id')
            ->select(
                'p.name',
                'o.payment_type',
                'o.code',
                'p.price',
                'o.status',
                'o.created_at'
            )
            ->where('user_id',Auth::user()->id)
            ->wherein('o.status',['Paga','pending','Aguardando pagamento','Devolvida'])
            ->orderby('o.id','desc')
            ->get();

        return view('anaminese.pedidos',['orders'=>$order]);
    }
}
