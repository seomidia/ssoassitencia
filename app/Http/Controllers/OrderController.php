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
         $this->middleware('auth');
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
                'o.id as order',
                'p.id as produto_id',
                'p.name',
                'o.payment_type',
                'o.code',
                'p.price',
                'o.total',
                'o.status',
                'o.created_at'
            )
            ->where('user_id',Auth::user()->id)
            ->wherein('o.status',['Paga','pedding','Aguardando pagamento','Devolvida','Cancelada'])
            ->orderby('o.id','desc')
            ->get();

        $colection = collect($order)
            ->groupBy('order')
            ->map(function ($item) {
                return array_merge($item->toArray());
            });


        return view('anaminese.pedidos',['orders'=>$colection]);
    }
}
