<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use DB;
class Checkout extends Model
{

    protected function SessionCode($PAGSEGURO_EMAIL,$PAGSEGURO_TOKEN,$SANDBOX_ENVIRONMENT = true)
    {
//        $PAGSEGURO_API_URL = 'https://ws.pagseguro.uol.com.br/v2';
//        if($SANDBOX_ENVIRONMENT){
//            $PAGSEGURO_API_URL = 'https://ws.sandbox.pagseguro.uol.com.br/v2';
//        }
//
//        $params = array(
//            'email' => $PAGSEGURO_EMAIL,
//            'token' => $PAGSEGURO_TOKEN
//        );
//
//        $header = array();
//
//
//        $response = $this->curlExec($PAGSEGURO_API_URL."/sessions", $params, $header);
//        $json = json_decode(json_encode(simplexml_load_string($response)));
//        return $json->id;
    }
    protected function pagseguro($field)
    {


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions?email=suporte@seomidia.com.br&token=64E41DAABAFE41F29B6E431CB18C87CF',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query($field, '', '&'),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;

    }
    protected function curlExec($url, $post = NULL, array $header = array()){
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if(count($header) > 0) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        if($post !== null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post, '', '&'));
        }

        //Ignore SSL
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }
    protected function add_orde($user_id, array $data)
    {

        $order = new \App\Order();
        $order->user_id = $user_id;
        $order->session_id = $_COOKIE["session_key"];
        $order->save();

        DB::table('order_shipping')->insert([
            'order_id' => $order->id,
            'companies_id' => $data['empresa_id'],
            'name' => $data['nome'],
            'sobrenome' => $data['sobrenome'],
            'empresa' => $data['empresa_id'],
            'endereco' => $data['endereco'],
            'complemento' => $data['complemento'],
            'uf'=> $data['uf'],
            'cep' => $data['cep'],
            'email' => $data['email'],
            'telefone'=> $data['telefone'],
            'obs' => $data['obs'],
            'card_number' => $data['cardNumber'],
            'card_validate' => $data['cardExpiry'],
            'cvv' => $data['cardCVC'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('order_products')
            ->where('session_id',$_COOKIE["session_key"])
            ->update(['order_id'=>$order->id]);

    }
    protected  function fields($data)
    {
        return [
          'paymentMode' => 'default',
          'paymentMethod' => 'boleto',
          'receiverEmail' => 'suporte@seomidia.com.br',
          'currency' => 'BRL',
          'extraAmount' => '1.00',
          'itemId1' => '0001',
          'itemDescription1' => 'NotebookPrata',
          'itemAmount1' => '24300.00',
          'itemQuantity1' => '1',
          'notificationURL' => 'https://sualoja.com.br/notifica.html',
          'reference' => 'REF1234',
          'senderName' => 'JoseComprador silvaa',
          'senderCPF' => '22111944785',
          'senderAreaCode' => '11',
          'senderPhone' => '56273440',
          'senderEmail' => 'c01185972120163344535@sandbox.pagseguro.com.br',
          'senderHash' => 'd6bd7115c9f57d40d424566c88432c4468aeb5070545647df7a04a542aafd845',
          'shippingAddressStreet' => 'Av.Brig.FariaLima',
          'shippingAddressNumber' => '1384',
          'shippingAddressComplement' => '5oandar',
          'shippingAddressDistrict' => 'JardimPaulistano',
            'shippingAddressPostalCode' => '01452002',
            'shippingAddressCity' => 'SaoPaulo',
            'shippingAddressState' => 'SP',
            'shippingAddressCountry' => 'BRA',
            'shippingType' => '1',
            'shippingCost' =>'1.00'
        ];
    }


}
