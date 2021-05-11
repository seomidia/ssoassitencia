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
            ->get();
        return view('exames.listagem',['exames'=>$exames]);
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
}
