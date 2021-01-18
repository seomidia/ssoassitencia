<?php

namespace App\Http\Controllers;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $company = DB::table('companies');
        $data = $request->all();

        if($company->where('cnpj',$data['cnpj'])->count() == 0){

            unset($data['_token']);

            if($company->insert($data)){
                return [
                    'success' => true,
                    'message' => 'Empresa Cadastrada com Sucesso!',
                    'icon' => 'success',
                    'link' => '/checkout'
                ];
            }

        }else{
            return [
                'success' => false,
                'message' => 'Empresa já esta cadastra, deseja tentar novamente?',
                'icon' => 'warning',
                'link' => '/checkout'
            ];
        }

    }
}
