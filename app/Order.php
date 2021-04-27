<?php

namespace App;

use Laravel\Scout\Searchable;
use TCG\Voyager\Models\User;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{

    protected $fillable = [
        'user_id','session_id','payment_type','total','code'
    ];


    protected function CreateOrder(array $data,$code)
    {
        $data['email'] = $data[1];
        $data['password'] = bcrypt($data[2]);


        // checa se user existe, se nao existir será cadastrado --------------------

        $UserCount = User::where('email',$data['email']);

        if($UserCount->count() == 0){
                \App\User::User_register($data,'cliente');
        }

        // obtem dados de usuario cadastrado --------------------------
        $user = $UserCount->get();
        $orderD = [
            'user_id' =>  $user[0]->id,
            'session_id' => $_COOKIE["session_key"],
            'payment_type' => 'Pagseguro online',
            'total' => $code['total'],
            'code' => $code['code'],
        ];
        //cria uma nova order -----------------------------------------
        $order = $this->create($orderD);

        $cart = DB::table('cart_products');
        $order_products = DB::table('order_products');

        // migrar da table cart_products para a order_products ---------------------
        $cart_list = $cart->where('session_id',$_COOKIE["session_key"])->get();
        foreach ($cart_list as $item){
            $order_products->insert([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'qtd' => $item->qtd,
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
            ]);

        }
        // deleta registros da cart_products --------------------------------
        $cart->where('session_id','=',$_COOKIE["session_key"])->delete();

        // criar um novo registro na order_shipping ------------------------

//        $order_shipping = DB::table('order_shipping');
//
//        $pedido = $order_shipping->insert([
//        'order_id' => $order->id,
//        'companies_id' => $data['empresa_id'],
//        'name' =>  $data['nome'],
//        'sobrenome' =>  $data['sobrenome'],
//        'empresa' => '',
//        'endereco' => $data['endereco'],
//        'complemento' =>  $data['complemento'],
//        'uf' =>  $data['uf'],
//        'cep' =>  $data['cep'],
//        'email' => $data['email'],
//        'telefone' => $data['telefone'],
//        'obs' => $data['obs'],
//        'card_number' => '',
//        'card_validate' => '',
//        'cvv' => '',
//        'created_at' => date('Y-m-d H:m:s'),
//        'updated_at' => date('Y-m-d H:m:s')
//        ]);

//        if($pedido){
//            return [
//                'success' => true,
//                'message' => 'Pedido finalizado com sucesso!',
//                'icon' => 'success',
//                'link' => '/obrigado'
//            ];
//        }else{
//            return [
//                'success' => false,
//                'message' => 'Houve um erro, tente novamente mais tarde!',
//                'icon' => 'danger',
//                'link' => '/'
//            ];
//        }





    }
}
