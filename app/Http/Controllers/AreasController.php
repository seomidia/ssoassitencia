<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Area;
use DB;
class AreasController extends Controller
{

    public function Cliente(){

        $listaPedido = Area::Pedidos(Auth::user()->id);

        dd($listaPedido);

        return view('vendor.voyager.cliente.area-cliente');
    }
}
