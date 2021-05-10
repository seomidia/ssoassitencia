<?php

namespace App\Http\Controllers;

use App\Product;
use DB;
use App\Cart;
use App\Checkout;
use App\Order;
use Illuminate\Http\Request;
use PagSeguro;
use Validator,Redirect,Response;
use Auth;
use Illuminate\Support\Str;


class CheckoutController extends Controller
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
    public function index()
    {
        $session_id = $_COOKIE["session_key"];

        $products = DB::table('cart_products as cp')
            ->join('products as p','cp.product_id','=','p.id')
            ->where('cp.session_id',$session_id)
            ->select('p.id','p.name','p.price','p.sale','cp.qtd')
            ->get();

        $calc = Cart::Calculo($products);

        return view('checkout',[
            'produtos' => $products,
            'subtotal' => $calc['subtotal'],
            'total' => $calc['total'],
            'sessionCode' => ''
        ]);

    }
//
//    public static function Notification($information)
//    {
//        $data = (object) $information;
//        dd($data->code);
//        \Log::debug(print_r($information->getStatus()->getCode(), 1));
//    }

    public static function Notification(Request $request){
        $notificationCode = $request->input('notificationCode');

        $credentials = PagSeguro::credentials()->get();
        $transaction = PagSeguro::transaction()->get($notificationCode, $credentials);
        $information = $transaction->getInformation();

        $reference = $information->getReference();
        $status    = $information->getStatus();


        $order = DB::table('orders')
            ->where('orders.code',$reference);

        $datalhes = $order->select('user_id','id')->first();

        if($order->count() > 0){
            $order->update(['status'=> $status->getName()]);
        }

        //-- eventos -------------------------------------------
        if($status->getCode() == 3){
            $servico = new \stdClass();
            $servico->codeStatus = $status->getCode();
            $servico->nameStatus = $status->getName();
            $servico->useridOrder = $datalhes->user_id;
            $servico->idOrder = $datalhes->id;

            Product::CreateService($servico);
        }
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

    public function getUserData($field){
        $date = DB::table('user_data')
            ->select($field)
            ->where('user_id',Auth::user()->id)
            ->get();
        return $date[0]->$field;
    }
    public function finalizar(Request $request)
    {


        if(Auth::check()) {
            if(!is_null($request->prod))
                 $cartProd = $request->prod;
            $cartProd[] =[
                'name' =>'prod[]',
                'value' => $_COOKIE["prod_consulta"]
            ];
            foreach ($cartProd as $ids) {
                $prods[] = $ids['value'];
            }


            $prod = DB::table('products')
                ->wherein('id', $prods)
                ->get();
            $total = 0;
            foreach ($prod as $key => $value) {
                $total = $total + $value->price;
                $item[] = [
                    'id' => $value->id,
                    'description' => $value->name,
                    'quantity' => '1',
                    'amount' => $value->price,
                    'weight' => '0',
                    'shippingCost' => '0',
                    'width' => '0',
                    'height' => '0',
                    'length' => '0',
                ];
            }

            $referencia = (string) Str::uuid();

            $data = [
                'items' => $item,
                'shipping' => [
                    'address' => [
                        'postalCode' => $this->getUserData('cep'),
                        'street' => $this->getUserData('endereco'),
                        'number' => $this->getUserData('numero'),
                        'district' => $this->getUserData('bairro'),
                        'city' => $this->getUserData('cidade'),
                        'state' => $this->getUserData('estado'),
                        'country' => 'BRA',
                    ],
                    'type' => 2,
                    'cost' => ''
                ],
                'sender' => [
                    'email' => Auth::user()->email,
                    'name' => Auth::user()->name,
                    'documents' => [
                        [
                            'number' => $this->getUserData('cpf'),
                            'type' => 'CPF'
                        ]
                    ],
                    'phone' => [
                        'number' => substr($this->getUserData('telefone'), -9, 9),
                        'areaCode' => substr($this->getUserData('telefone'), 0, -9),
                    ],
                    'bornDate' => date("Y-m-d", strtotime(str_replace('/', '-', $this->getUserData('nasc')))),
                ],
                'reference' => $referencia
            ];

            $checkout = PagSeguro::checkout()->createFromArray($data);
            $credentials = PagSeguro::credentials()->get();
            $information = $checkout->send($credentials); // Retorna um objeto de laravel\pagseguro\Checkout\Information\Information
            if ($information) {
                $code['code'] = $referencia;
                $code['total'] = $total;
                Order::CreateOrder($code);
            }
            return response()->json($information->getLink());
        }else{
            return response()->json([
                'status' => false,
                'message' => 'É necessarios estar logado para finalizar o agendamento!'
            ],500);
        }
    }
//print_r($information->getCode());
//print_r($information->getDate());
//print_r($information->getLink());

}
