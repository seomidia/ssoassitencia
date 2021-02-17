<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Company;
use DB;

class AnamineseController extends Controller
{
    public function index(){
        $listagem = DB::table('anamnesis as a')
            ->leftjoin('companies as c','a.companies_id','=','c.id')
            ->leftjoin('users as u','a.user_id_employee','=','u.id')
            ->leftjoin('office as o','a.office_id','=','o.id')
            ->select(
                'a.*',
                'c.nome as empresa',
                'u.name as funcionario',
                'o.name as cargo'
            )
            ->orderBy('a.id', 'desc')
            ->get();
        return view('anaminese.listagem',['anamnese' => $listagem]);
    }
    public function cadastro($id){
        $user_logged = Auth::user()->id;
        $dados = DB::table('anamnesis as a')
            ->leftjoin('companies as c','a.companies_id','=','c.id')
            ->leftjoin('users as u','a.user_id_employee','=','u.id')
            ->leftjoin('user_data as ud','a.user_id_employee','=','ud.user_id')
            ->leftjoin('office as o','a.office_id','=','o.id')
            ->select(
                'a.*',
                'c.*',
                'ud.rg',
                'ud.cpf',
                'ud.nasc',
                'ud.idade',
                'ud.sexo',
                'u.name as funcionario',
                'o.name as cargo'
            )
            ->where('a.id',$id)
            ->get();
        return view('anaminese.update',['anamnese_id' => $id, 'user_logged' => $user_logged, 'dados'=> $dados]);
    }
    public function create(Request $request){

        return DB::table('anamnesis')->insertGetId([
            'user_id_logged' => Auth::user()->id,
            'requester' => Auth::user()->id,
            'step' => 'step_rh'
        ]);

    }
    public function updade(Request $request,$id){

        $companie_id = Company::Cheking($request->input('empresa'));

        if($companie_id['success']){

            $updade = DB::table('anamnesis')
                ->where('id',$id)
                ->update([
                    'user_id_employee' => $request->input('user_funcionario'),
                    'user_id_logged' => $request->input('user_logged'),
                    'companies_id' => $companie_id['companie_id'],
                    'office_id' => $request->input('cargo'),
                    'ambiente_trabalho' => $request->input('ambiente_Trabalho'),
                    'step' => 'step_fuci'
                ]);


            if($updade){
                return response()->json([
                    'success'=> true,
                    'message'=> 'Primeira etapa foi concluida e encaminhada para o funcionario!'
                ],200);
            }else{
                return response()->json([
                    'success'=> false,
                    'message'=> 'Não foi possivel criar anamnese' . $updade
                ],500);
            }

        }else{
            return response()->json([
                'success'=> false,
                'message'=> $companie_id['message']
            ],500);

        }
    }
    public function destroy($id){
        $delete = DB::table('anamnesis')
            ->where('id',$id)
            ->delete();

        if($delete){
            return response()->json([
                'success'=> true,
                'message'=> 'Encaminhamento removido com sucesso!'
            ],200);
        }else{
            return response()->json([
                'success'=> false,
                'message'=> 'Não foi possivel remover encaminhamento' . $updade
            ],500);
        }

    }
}
