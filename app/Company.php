<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Company extends Model
{
    protected function Cheking($cnpj){
        $cnpj = str_replace(['.','/','-'],['','',''],$cnpj);

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
        $data_vetor = json_decode($response);
        curl_close($curl);



        $total = DB::table('companies')
            ->where('cnpj',$cnpj);

        $data = [
            'cnpj' => preg_replace('/[^0-9]/', '', $data_vetor->cnpj),
            'abertura' => date('Y-m-d H:i:s', strtotime(str_replace('/','-', $data_vetor->abertura))),
            'nome' => $data_vetor->nome,
            'nome_fantasia' => $data_vetor->fantasia,
            'endereco' => $data_vetor->logradouro,
            'numero' => $data_vetor->numero,
            'complemento' => $data_vetor->complemento,
            'cep' => $data_vetor->cep,
            'bairro' => $data_vetor->bairro,
            'cidade' => $data_vetor->municipio,
            'telefone' => $data_vetor->telefone,
            'uf' =>  $data_vetor->uf,
        ];


        if($total->count() >= 1){
            $data['updated_at'] = date('Y-m-d H:i:s');
            $campanie_id = $total->select('id')->get();
            $updade = DB::table('companies')
                ->where('id',$campanie_id[0]->id)
                ->update($data);

            return [
                'success' => true,
                'companie_id'=> $campanie_id[0]->id,
                'data' => $data_vetor,
            ];
        }else{
            $data['created_at'] = date('Y-m-d H:i:s');
            $insert = DB::table('companies')->insertGetId($data);

            if(isset($insert)){
                return [
                    'success'=> true,
                    'companie_id'=> $insert,
                    'data' => $data_vetor
                ];
            }else{
                return [
                    'success'=> false,
                    'message'=> 'Nao foi possivel cadastrar empresa! ' . $insert
                ];

            }

        }


    }

}
