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

    function getEmpresa($cnpj){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://www.receitaws.com.br/v1/cnpj/' . $cnpj,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => array('_token' => 'YinUdocObgzquz7QUA6Fh9Ch7EhoFDbrZ6mvjyhM'),
            CURLOPT_HTTPHEADER => array(
                'Cookie: JSESSIONID=ed179333b826d9026424e4b7dd183e4d36c2892d'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;

    }
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
