<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Cart extends Model
{

    protected function ChecCartFront()
    {

        return DB::table('cart_products')
            ->where('session_id',$_COOKIE["session_key"])
            ->count();

    }
    protected function CheckCart($session_id,$product_id)
    {
        return DB::table('cart_products')
            ->where('session_id',$session_id)
            ->where('product_id',$product_id)
            ->count();
    }

    protected function Calculo($products){

        $subtotal = [];
        $total = [];

        foreach ($products as $key => $product) {
                $subtotal[$key] =  $product->price * $product->qtd ;
                $total[$key] =  ($product->price - $product->sale) * $product->qtd;
        }



        return [
            'subtotal' => array_sum($subtotal),
            'total' => array_sum($total)
        ];
    }

}
