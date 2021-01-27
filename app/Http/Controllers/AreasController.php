<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class AreasController extends Controller
{

    public function Cliente(){

        return view('vendor.voyager.cliente.area-cliente');
    }
}
