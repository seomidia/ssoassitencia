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

        $data = [
            'nome'           => $request->input('nome'),
            'email'          => $request->input('email'),
            'password'       => bcrypt($cpf)
        ];

        $user_id = \App\User::User_register($data);

        if($user_id['success']){

            $user_data = DB::table('user_data')->insert([
                'user_id' => $user_id['data']['user_id'],
                'cpf' => $request->input('cpf'),
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
                        'cpf' => $request->input('cpf'),
                        'nome' => $request->input('nome'),
                        'rg' => $request->input('rg'),
                        'nascimento' => $request->input('nascimento'),
                        'idade' => $request->input('idade'),
                        'sexo' => $request->input('sexo')
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

        $people = DB::table('user_data');
        $buscar = $people->where('cpf',$cpf);

        $cpf    = str_replace('.','',$cpf);

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
                    'user_data.sexo as sexo'
                )
                ->get();

            return response()->json([
                'success'=> true,
                'message'=> '',
                'data' => [
                    'id' => $pessoa[0]->id,
                    'cpf' => $pessoa[0]->cpf,
                    'nome' => $pessoa[0]->nome,
                    'rg' => $pessoa[0]->rg,
                    'nascimento' => $pessoa[0]->nascimento,
                    'idade' => $pessoa[0]->idade,
                    'sexo' => $pessoa[0]->sexo
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
