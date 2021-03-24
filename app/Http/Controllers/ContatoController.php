<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class ContatoController extends Controller
{
    public function index(){
        return view('contato');
    }

}
