<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use DB;
class CompanyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function getEmpresa($cnpj){
        if($cnpj != ''){
            return  Company::Cheking(preg_replace('/[^0-9]/', '', $cnpj));
        }
        return;
    }
}
