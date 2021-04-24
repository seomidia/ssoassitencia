<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class CategoryController extends Controller
{

    public function getCategory($id = null){
        if(!is_null($id)){
            $prod = DB::table('products as p')
                ->leftjoin('categories as c','p.category_id','=','c.id')
                ->select('c.id','c.name')
                ->where('p.id',$id)
                ->get();

            $cat[] = [
                'id' => $prod[0]->id,
                'name' => $prod[0]->name,
                'selected' => true
            ];
        }
        $Category = DB::table('categories')
            ->get();

        foreach ($Category as $item) {
            $cat[] = [
                'id' => $item->id,
                'name' => $item->name,
                'selected' => false
            ];
        }

        return response()->json(['data' => $cat]);
    }

}
