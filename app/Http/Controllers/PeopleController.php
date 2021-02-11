<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Str;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\User;

class PeopleController extends Controller
{
    function CreatePessoa(Request $request){
        dd($request->all());
    }
    function getPessoa(Request $request,$cpf){

        $people = DB::table('user_data');
        $buscar = $people->where('cpf',$cpf);

        $cpf    = str_replace('.','',$cpf);

        $total  = $buscar->count();

        if($total > 0){
            dd($buscar->get());
        }else{
            return response()->json([
                'success'=> false,
            ],200);
        }
    }
}
