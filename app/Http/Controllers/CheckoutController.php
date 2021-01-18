<?php

namespace App\Http\Controllers;

use DB;
use App\Cart;
use App\Checkout;
use App\Order;
use Illuminate\Http\Request;
use Validator,Redirect,Response;


class CheckoutController extends Controller
{
    protected $PAGSEGURO_API_URL;
    protected $PAGSEGURO_EMAIL;
    protected $PAGSEGURO_TOKEN;
    protected $SANDBOX_ENVIRONMENT;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->PAGSEGURO_API_URL = 'https://ws.pagseguro.uol.com.br/v2';
        if($this->SANDBOX_ENVIRONMENT){
            $this->PAGSEGURO_API_URL = 'https://ws.sandbox.pagseguro.uol.com.br/v2';
        }

        $this->PAGSEGURO_EMAIL = 'suporte@seomidia.com.br';
        $this->PAGSEGURO_TOKEN = '64E41DAABAFE41F29B6E431CB18C87CF';
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $session_id = $_COOKIE["session_key"];

        $products = DB::table('cart_products as cp')
            ->join('products as p','cp.product_id','=','p.id')
            ->where('cp.session_id',$session_id)
            ->select('p.id','p.name','p.price','p.sale','cp.qtd')
            ->get();

        $calc = Cart::Calculo($products);
        $sessionCode = Checkout::SessionCode('suporte@seomidia.com.br','64E41DAABAFE41F29B6E431CB18C87CF',true);

        return view('checkout',[
            'produtos' => $products,
            'subtotal' => $calc['subtotal'],
            'total' => $calc['total'],
            'sessionCode' => $sessionCode
        ]);

    }
    public function Autocomplete(Request $request)
    {
        $search = $request->input('search');
        $result = DB::table('companies')
            ->where('nome_fantasia', 'like', '%'. $search .'%')
            ->get();

        $companies = [];
        if(count($result)){
            foreach ($result as $item) {
                $companies[] = array("success"=>true, "value"=>$item->id,"label"=>$item->nome_fantasia);
            }
        }else{
            $companies[] = array("success"=>false, "value"=> '',"label"=> '');
        }

        return response()->json($companies);
    }
    public function obrigado()
    {
        return view('obrigado');
    }
    public function finalizar(Request $request)
    {
     return Order::CreateOrder($request->all());

    }

}
