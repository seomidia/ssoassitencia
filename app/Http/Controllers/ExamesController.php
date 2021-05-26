<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class ExamesController extends Controller
{

    public function index(){
        $exames = \DB::table('exame as e')
            ->join('orders as os','e.order_id','=','os.id')
            ->join('products as p','e.product_id','=','p.id')
            ->leftjoin('exame_file as ef','e.id','=','ef.exame_id')
            ->select(
                'e.id',
                'p.name',
                'e.status',
                'e.created_at',
                'ef.path_file'
            )
            ->where('e.user_id',Auth::user()->id)
            ->get();

            $role = \DB::table('user_roles')->where('user_id',Auth::user()->id)->get();
            $permissao = (count($role) > 0) ? $role[0]->role_id : '';

        return view('exames.listagem',['exames'=>$exames,'permissao' =>$permissao]);
    }

    public function upload(Request $request){

        $exame_id = $request->input('exame_id');
        $path = $request->arquivo->store('public/exames');
        $path = str_replace('public','storage',$path);

        $data = [
            'exame_id' => $exame_id,
            'path_file' => $path
        ];

        $insertfile = DB::table('exame_file')->insert($data);
        if($insertfile){
            $updateExame = DB::table('exame')->where('id',$exame_id)->update(['status'=>1]);
            if($updateExame){
                return response()->json([
                    'success' => true,
                    'message' => 'Exame atualizado com sucesso!'
                ],200);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Não foi possivel atualizar o exame!'
                ],500);
            }
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Não foi anexar o arquivo!'
            ],500);
        }
    }
    public function transfere(Request $request)
    {

        $data = $request->all();

        if($data['user_id'] == ''){
            return response()->json([
                'success' => false,
                'message' => 'Destino é obrigatório!'
            ],500);
        }elseif($data['exid'] == ''){
            return response()->json([
                'success' => false,
                'message' => 'Exame é obrigatório!'
            ],500);
        }else{
            $update = \DB::table('exame')->where('id',$data['exid'])->update([
                'user_id' => $data['user_id']
            ]);

            if($update)
                return response()->json([
                    'success' => true,
                ],200);

            return response()->json([
                'success' => false,
            ],500);

        }
    }

    public function checar(Request $request){
        $data = $request->all();

        foreach ($data as $key => $value){
            if ($value == '')
                return response()->json([
                  'success' => false,
                  'message' => 'O campos ' . $key . ' é obrigatório!'
                ],500);
        }

        $procedures = DB::table('order_products as op')
            ->leftjoin('products as p','op.product_id','=','p.id')
            ->leftjoin('orders as o','op.order_id','=','o.id')
            ->select(
                'op.id',
                'op.status',
                'op.anamnesis_id'
            )
            ->where(['o.user_id'=>Auth::user()->id,'op.product_id'=>$data['exid']]);

        $total = $procedures->count();
        $result = $procedures->first();
        if($total > 0){

        if($result->status == 0){
            $status = true;
            $anamnesis_id = $data['anamnese_id'];
        }else{
            $status = false;
            $anamnesis_id = null;
        }

            $update = \DB::table('order_products')->where('id',$result->id)
            ->update([
                'status'=> $status,
                'anamnesis_id' =>$anamnesis_id,
            ]);

        if ($update)
            return response()->json([
                'success' => true,
                'message' => 'Exame vinculado a anamnesi de codigo: ' . $data['anamnese_id']
            ],200);

        return response()->json([
            'success' => false,
            'message' => 'Não foi possivel vincular o exame!'
        ],500);
        }

    }
}
