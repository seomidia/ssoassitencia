<?php

namespace App\Http\Controllers;

use App\Product;
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
    public function CreateService($id,$order){


        $products = \DB::table('products')
            ->where('id',$id)->get();

        $servico = new \stdClass();
        $servico->user_id_logged = Auth::user()->id;
        $servico->requester = Auth::user()->id;
        $servico->step = 'step_site';

        foreach ($products as $key => $product){
            if(!is_null(Product::getConsulta($product->id)))
                $servico->consulta = Product::getConsulta($product->id);

            if(!is_null(Product::getExames($product->id))){
                $servico->exames = Product::getExames($product->id);
            }
        }

        if(!empty($servico->consulta)){
            $anamnesi_id = \App\Anamnesi::CreateAnamnesi($servico);
        }


        if(!empty($servico->exames)){
            $servico->order = $order;
            \App\Anamnesi::ExameAnamnesiRelationship($servico);
        }

        \DB::table('order_products')->where(['order_id'=>$order,'product_id'=>$id])
            ->update([
                'status'=> true
            ]);


    }
    public function pedidos()
    {
        $order = \DB::table('orders as o')
            ->join('order_products as op','o.id','=','op.order_id')
            ->join('products as p','op.product_id','=','p.id')
            ->select(
                'o.id as order',
                'p.id as produto_id',
                'op.status as sprod',
                'p.name',
                'o.payment_type',
                'o.payment_type',
                'o.code',
                'p.price',
                'o.total',
                'o.status',
                'o.created_at'
            )
            ->where('user_id',Auth::user()->id)
            ->wherein('o.status',['Paga','Disponível','pedding','Em disputa','Em análise','Aguardando pagamento','Devolvida','Cancelada'])
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
