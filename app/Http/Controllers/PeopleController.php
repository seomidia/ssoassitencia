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

            $user_data = DB::table('user_data')->insert([
                'user_id' => $user_id['data']['user_id'],
                'cpf' => str_replace(['.','-'],['',''],$request->input('cpf')),
                'rg' => $request->input('rg'),
                'nasc' => $request->input('nascimento'),
                'idade' => $request->input('idade'),
                'sexo' => $request->input('sexo'),
                'estado_civil' => $request->input('estado_civil'),
                'telefone' => $request->input('telefone'),
                'cep' => $request->input('cep'),
                'endereco' => $request->input('endereco'),
                'numero' => $request->input('numero'),
                'complemento' => $request->input('complemento'),
                'bairro' => $request->input('bairro'),
                'cidade' => $request->input('cidade'),
                'estado' => $request->input('uf'),
            ]);


            if($user_data){

                return response()->json([
                    'success'=> true,
                    'message'=> 'Pessoa cadastrada com sucesso!',
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
