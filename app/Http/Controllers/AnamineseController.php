<?php

namespace App\Http\Controllers;

use App\Anamnesi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Company;
use DB;

class AnamineseController extends Controller
{

    // RH ------------------------------------------------------------
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
            ->where('requester',Auth::user()->id)
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
            'step' => 'step_rh',
            'created_at' => date('Y-m-d H:i:s')
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
                    'step' => 'step_funci'
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

    //FUNCTIONARIO ---------------------------------------------------

    public function indexfunc()
    {
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
            ->where('user_id_employee',Auth::user()->id)
            ->whereIn('step',['step_funci','step_med'])
            ->orderBy('a.id', 'desc')
            ->get();

        return view('anaminese.funcionario.listagem',['anamnese' => $listagem]);
    }
    public function devolver(Request $request)
    {
        $id = $request->input('anamnese_id');
        $motivo = $request->input('motivo');

        if($id == ''){
            return response()->json([
                'success'=> false,
                'message'=> 'Não existe anamnse vinculada!'
            ],500);
        }elseif ($motivo == ''){
            return response()->json([
                'success'=> false,
                'message'=> 'O motivo é obrigatório informar!'
            ],500);
        }else{
        $updade = DB::table('anamnesis')
            ->where('id',$id)
            ->update([
                'message' => $motivo,
                'step' => 'step_rh'
            ]);

            if($updade){
                return response()->json([
                    'success'=> true,
                    'message'=> 'Anamnese devolvida para o RH responsável!'
                ],200);
            }else{
                return response()->json([
                    'success'=> false,
                    'message'=> 'Não foi possivel devolver anamnese' . $updade
                ],500);
            }
        }
    }
    public function question($id)
    {
        $dados = DB::table('anamnesis as a')
            ->leftjoin('users as u','a.user_id_employee','=','u.id')
            ->leftjoin('user_data as ud','a.user_id_employee','=','ud.user_id')
            ->select(
                'ud.cpf',
                'ud.nasc',
                'u.name as funcionario'
            )
            ->where('a.id',$id)
            ->get();

        return view('anaminese.funcionario.update',['anamnese_id' => $id, 'user_id' => Auth::user()->id, 'dados'=> $dados]);

    }

    public function questionStore(Request $request){
        $data = $request->question;
        $user = $request->input('user_id_employee');
        $anamnese_id = $request->input('anamnesis_id');
        $anamnese = Anamnesi::add_meta_question(['user_id_employee'=> $user,'anamnesis_id'=>$anamnese_id],$data);
        if($anamnese['success']){
           DB::table('anamnesis')
                ->where('id',$anamnese_id)
                ->update([
                    'step' => 'step_med',
                    'realization_date' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            return response()->json([
                'success'=> true,
                'message'=> 'Anamnese encaminhada para medico!'
            ],200);
        }
    }

    public function Busca(){

        if(isset($_GET['filter']) && $_GET['filter'] =='nome' ){
            $filter = 'user_id_employee';
            $result = DB::table('users as u')
                ->leftjoin('user_data as ud','u.id','=','ud.user_id')
                ->select(
                    'u.id',
                    'u.name',
                    'ud.cpf',
                    'ud.nasc'
                )
                ->where('name',$_GET['buscar'])
                ->get();
            $value  = $result;
        }elseif(isset($_GET['filter']) && $_GET['filter'] =='cpf'){
            $filter = 'user_id_employee';
            $result = DB::table('users as u')
                ->leftjoin('user_data as ud','u.id','=','ud.user_id')
                ->select(
                    'u.id',
                    'u.name',
                    'ud.cpf',
                    'ud.nasc'
                )
                ->where('cpf',$_GET['buscar'])
                ->get();
            $value  = $result;
        }elseif(isset($_GET['filter']) && $_GET['filter'] =='cnpj'){
            $filter = 'companies_id';
            $result = DB::table('companies')->select('id')->where('cnpj',$_GET['buscar'])->get();
            $value  = $result;
        }

        return view('vendor/voyager/index',['paciente' => $value,'filtro' => $filter]);
    }

    static function get_anamnese($filtro,$id){
        return DB::table('anamnesis as a')
            ->leftjoin('companies as c','a.companies_id','=','c.id')
            ->select(
                'a.*',
                'c.nome',
                'c.cnpj'
            )
            ->where($filtro,$id)->get();
    }

    static function questions($user_id,$anamnese_id){
        $input = DB::table('meta_resposes')
            ->where('user_id_employee',$user_id)
            ->where('anamnesis_id',$anamnese_id)
            ->get();

        return collect($input)
            ->groupBy('section')
            ->map(function ($item) {
                return array_merge($item->toArray());
            });
    }
}

