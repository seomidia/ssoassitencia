<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class AnamineseController extends Controller
{
    public function index(){
        return view('anaminese.listagem');
    }
    function cadastro($id){
        return view('anaminese.update');
    }
    public function create(Request $request){

        return DB::table('anamnesis')->insertGetId([
            'user_id_logged' => Auth::user()->id,
        ]);

    }
}
