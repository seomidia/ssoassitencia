<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Area extends Model
{

    protected function Pedidos($user_id)
    {
        return DB::table('orders as o')
            ->join('users as u','o.user_id','=','u.id')
            ->join('roles as r','u.role_id','=','r.id')
            ->join('order_shipping as os','o.id','=','os.order_id')
            ->select(
                'o.user_id',
                'o.status',
                'payment_type',
                'created_at'
            )
            ->get();
    }

}
