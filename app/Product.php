<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Product extends Model
{

    protected function get_product(array $prod){
        $ids = [];
        for ($i = 0; $i < count($prod); $i++){
            $ids[] = $prod[$i]['product_id'];
        }

        $query = DB::table('products')
                 ->select('id','name','image','slug','price', 'sale')
                 ->wherein('id',$ids)
                 ->orderBy('id','DESC')
                 ->get();
        foreach ($query as $key => $item){
            $products[]   = [
            'id'=> $item->id,
            'name'=> $item->name,
            'image'=> $item->image,
            'slug'=> $item->slug,
            'price'=> $item->price,
            'sale'=> $item->sale,
            'qtd'=> $prod[$key]['qtd']
            ];
        }

        return $products;

    }

}
