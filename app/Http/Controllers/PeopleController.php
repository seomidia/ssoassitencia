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
    public static function phoneValidate($phone)
    {
        $regex = '/^(?:(?:\+|00)?(55)\s?)?(?:\(?([1-9][0-9])\)?\s?)?(?:((?:9\d|[2-9])\d{3})\-?(\d{4}))$/';

        if (preg_match($regex, $phone) == false) {

            // O número não foi validado.
            return false;
        } else {

            // Telefone válido.
            return true;
        }
    }
    public static function validaCPF($cpf) {

        // Extrai somente os números
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );

        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;

    }
    public static function CreatePessoa(Request $request){
        $cpf = $request->input('cpf');
        $telefone = $request->input('telefone');

        $cpf = str_replace(['.','-'],['',''],$cpf);

        if(!self::validaCPF($cpf)){
            return response()->json([
                'success'=> false,
                'message'=> 'O CPF é invalido'
            ],500);
        }
        $tel = str_replace(['(',')','-',' '],['','','',''],$telefone);
        if(!self::phoneValidate($tel)){
            return response()->json([
                'success'=> false,
                'message'=> 'O Telefone é invalido'
            ],500);
        }

        foreach ($request->all() as $key => $value){
            if($value == '')
                return response()->json([
                    'success'=> false,
                    'message'=> 'O campo ' . $key . ' é obrigatório'
                ],500);
        }


        $cpf = $request->input('cpf');
        $senha = preg_replace('/[^0-9]/', '', $cpf);

        $data = [
            'nome'           => $request->input('nome'),
            'email'          => $request->input('email'),
            'cpf'          => $cpf,
            'password'       => bcrypt($senha)
        ];

        $user_id = \App\User::User_register($data);
        if($user_id['success']){

            $dados = [
                'user_id' => $user_id['data']['user_id'],
                'cpf' => str_replace(['.','-'],['',''],$request->input('cpf')),
                'rg' => $request->input('rg'),
                'nasc' => $request->input('nascimento'),
                'idade' => $request->input('idade'),
                'sexo' => $request->input('sexo'),
                'estado_civil' => $request->input('estado_civil'),
                'telefone' => $tel,
                'cep' => $request->input('cep'),
                'endereco' => $request->input('endereco'),
                'numero' => $request->input('numero'),
                'complemento' => $request->input('complemento'),
                'bairro' => $request->input('bairro'),
                'cidade' => $request->input('cidade'),
                'estado' => $request->input('uf'),
            ];

            if(isset($user_id['data']['user_id'])){
                $user_data = DB::table('user_data')->insert($dados);
                $msg = 'Pessoa cadastrada com sucesso!';
            }else{
                $user_data = DB::table('user_data')
                ->where('user_id',$user_id['data']['user_id'])
                ->update($dados);
                $msg = 'Pessoa atualizada com sucesso!';
            }


            if($user_data){

                return response()->json([
                    'success'=> true,
                    'message'=> $msg,
                    'data' => [
                        'id' => $user_id['data']['user_id'],
                        'cpf' => str_replace(['.','-'],['',''],$request->input('cpf')),
                        'nome' => $request->input('nome'),
                        'rg' => $request->input('rg'),
                        'nascimento' => $request->input('nascimento'),
                        'idade' => $request->input('idade'),
                        'sexo' => $request->input('sexo'),
                        'cidade' => $request->input('cidade'),
                        'uf' => $request->input('uf')
                    ]
                ],200);

            }else{
                return response()->json([
                    'success'=> false,
                    'message'=> 'Houve um erro ao cadastrar os dados da pessoa!'
                ],500);
            }

        }else{
            return response()->json([
                'success'=> false,
                'message'=> $user_id['message']
            ],500);

        }



    }
    function getPessoa(Request $request,$cpf){
        $cpf    = str_replace(['.','-'],['',''],$cpf);
        $people = DB::table('user_data');
        $buscar = $people->where('cpf',$cpf);

        $total  = $buscar->count();

        if($total > 0){
            $pessoa = $people->join('users','user_data.user_id','=','users.id')
                ->select(
                    'users.id as id',
                    'users.name as nome',
                    'user_data.cpf as cpf',
                    'user_data.rg as rg',
                    'user_data.nasc as nascimento',
                    'user_data.idade as idade',
                    'user_data.sexo as sexo',
                    'user_data.cidade',
                    'user_data.estado'
                )
                ->first();

            return response()->json([
                'success'=> true,
                'message'=> '',
                'data' => [
                    'id' => $pessoa->id,
                    'cpf' => $pessoa->cpf,
                    'nome' => $pessoa->nome,
                    'rg' => $pessoa->rg,
                    'nascimento' => $pessoa->nascimento,
                    'idade' => $pessoa->idade,
                    'sexo' => $pessoa->sexo,
                    'cidade' => $pessoa->cidade,
                    'uf' => $pessoa->estado
                ]
            ],200);
        }else{
            return response()->json([
                'success'=> false,
                'message'=> 'CPF incorreto ou pessoa nao existe!'
            ],404);
        }
    }
}
