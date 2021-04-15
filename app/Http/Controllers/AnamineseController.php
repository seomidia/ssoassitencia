<?php

namespace App\Http\Controllers;

use App\Anamnesi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Company;
use Illuminate\Notifications\Notifiable;
use DB;

class AnamineseController extends Controller
{
    use Notifiable;

    public function __construct()
    {
        $this->middleware('auth');
    }

    //  feedback medico ----------------------------------------------
    public function feedbackMedico(Request $request){


        $user        = $request->input('employee');
        $anamnese_id = $request->input('anamnese');
        $photo = $request->input('photo_employee');

        if($user == ''){
            return response()->json([
                'success' => false,
                'message' => 'Funcionario é obrigatório!'
            ],500);
        }elseif($anamnese_id == ''){
            return response()->json([
                'success' => false,
                'message' => 'Anamnese é inixistente!'
            ],500);
        }elseif($photo == ''){
            return response()->json([
                'success' => false,
                'message' => 'Foto do Funcionário é obrigatório!'
            ],500);
        }elseif(!isset($request->medico['aparelho-auditivo-e-visual'])){
            return response()->json([
                'success' => false,
                'message' => 'Informar Aparelho auditivo e visual é necessario!'
            ],500);
        }elseif(!isset($request->medico['cabeca-e-pescoco'])){
            return response()->json([
                'success' => false,
                'message' => 'Informar cabeça e pescoço é necessario!'
            ],500);
        }elseif(!isset($request->medico['aparelho-cardiorrespiratorio-e-vascular'])){
            return response()->json([
                'success' => false,
                'message' => 'Informar Aparelho Cardiorrespiratório e Vascular é necessario!'
            ],500);
        }elseif(!isset($request->medico['aparelho-locomotor'])){
            return response()->json([
                'success' => false,
                'message' => 'Informar Aparelho Locomotor é necessario!'
            ],500);
        }elseif(!isset($request->medico['torax-abdomen'])){
            return response()->json([
                'success' => false,
                'message' => 'Informar Tórax/Abdômen é necessario!'
            ],500);
        }elseif(!isset($request->medico['coluna-vertebral'])){
            return response()->json([
                'success' => false,
                'message' => 'Informar Coluna Vertebral é necessario!'
            ],500);
        }elseif(!isset($request->medico['membros-superiores'])){
            return response()->json([
                'success' => false,
                'message' => 'Informar Membros Superiores é necessario!'
            ],500);
        }elseif(!isset($request->medico['membros-inferiores'])){
            return response()->json([
                'success' => false,
                'message' => 'Informar Membros Inferiores é necessario!'
            ],500);
        }elseif(!isset($request->medico['pele-e-anexos'])){
            return response()->json([
                'success' => false,
                'message' => 'Informar Pele e Anexos é necessario!'
            ],500);
        }elseif(!isset($request->medico['avaliacao-psiquiatrica'])){
            return response()->json([
                'success' => false,
                'message' => 'Informar Avaliação Psiquiátrica é necessario!'
            ],500);
        }elseif(!isset($request->medico['termo'])){
            return response()->json([
                'success' => false,
                'message' => 'Informar o termo é necessario!'
            ],500);
        }elseif(!isset($request->medico['dataExame'])){
            return response()->json([
                'success' => false,
                'message' => 'Informar a data do exame é necessario!'
            ],500);
        }elseif(!isset($request->medico['dataExame'])){
            return response()->json([
                'success' => false,
                'message' => 'Informar a data do exame é necessario!'
            ],500);
        }elseif(!isset($request->medico['termo'])){
            return response()->json([
                'success' => false,
                'message' => 'Aceite o termo!'
            ],500);
        }else{
            $count = DB::table('meta_resposes')
                ->where(['anamnesis_id'=>$anamnese_id,'section'=>'medico'])
                ->count();
            $data = $request->all();
            $data['medico']['photo_employee'] = $photo;
            unset($data['photo_employee']);
            if($count == 0){
                Anamnesi::add_meta_question(['user_id_employee'=> $user,'anamnesis_id'=>$anamnese_id],$data);
                return response()->json([
                    'success' => true,
                    'anamnese_id' => $anamnese_id,
                    'message' => 'Avaliação cadastrada com sucesso!'
                ],200);
            }else{
                Anamnesi::add_meta_question(['user_id_employee'=> $user,'anamnesis_id'=>$anamnese_id],$data);
                return response()->json([
                    'success' => true,
                    'anamnese_id' => $anamnese_id,
                    'message' => 'Avaliação atualizada com sucesso!'
                ],200);

            }

        }
    }
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

        $procedures = DB::table('procedures')->get();
        $tipo = DB::table('anamnese_type')->get();
        $locais = DB::table('location')->where('status',1)->get();

        return view('anaminese.update',[
            'anamnese_id' => $id,
            'user_logged' => $user_logged,
            'dados'=> $dados,
            'procedures' => $procedures,
            'tipo' => $tipo,
            'locais' => $locais
        ]);
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

        $cnpj = $request->input('empresa');

        if($cnpj == '') {
            return response()->json([
                'success' => false,
                'message' => 'Informar o CNPJ é obrigatório!'
            ], 500);
        }


            $companie_id = Company::Cheking($cnpj);

        if($companie_id['success']){

            $func = $request->input('user_funcionario');
            if($func == ''){
                return response()->json([
                    'success'=> false,
                    'message'=> 'Informar o funcionario é obrigatório!'
                ],500);
            }

            $user = [
                'name' => $request->input('pessoa')
            ];

            $update_user = DB::table('users')
                ->where('id',$func)
                ->update($user);

            $pessoa = [
                'cpf' => str_replace(['.','-'],['',''],$request->input('pessoa_cpf')),
                'rg' => $request->input('pessoa_rg'),
                'nasc' => $request->input('pessoa_nascimento'),
                'idade' => $request->input('pessoa_idade'),
                'sexo' => $request->input('pessoa_sexo')
            ];


            $update_pessoa = DB::table('user_data')
                ->where('user_id',$func)
                ->update($pessoa);


            // atualiza empresa  --------------------------------------------------------
            $empresa = [
                'cnpj' => $request->input('empresa'),
                'endereco' => $request->input('empresa_endereco'),
                'bairro' => $request->input('empresa_bairro'),
                'numero' => $request->input('empresa_numero'),
                'cidade' => $request->input('empresa_cidade'),
                'uf' => $request->input('empresa_uf')
            ];

            $updade = DB::table('companies')
                ->where('id',$companie_id['companie_id'])
                ->update($empresa);

            // registra procedimentos -------------------------------------
            // checar ----
             $ehcreate = DB::table('anamnesis')->where(['id'=>$id,'step'=>'step_rh'])->count();
             if($ehcreate == 1){
                 Anamnesi::add_procedure($id,$request->medico['procedure']);
             }else{
                 Anamnesi::add_procedure($id,$request->medico['procedure'],true);
             }



            // atualiza anamnese --------------------------------------------------------

            $data = [
                'user_id_employee' => $func,
                'user_id_logged' => $request->input('user_logged'),
                'companies_id' => $companie_id['companie_id'],
                'office_id' => $request->input('cargo'),
                'ambiente_trabalho' => $request->input('ambiente_Trabalho'),
                'step' => 'step_funci',
                'type' => $request->input('anamnese_type'),
                'location_id' => $request->input('location_id'),
                'parecer' => $request->input('parecer')
            ];


            $updade = DB::table('anamnesis')
                ->where('id',$id)
                ->update($data);



            Anamnesi::notification($func,$id);
                return response()->json([
                    'success'=> true,
                    'message'=> 'Primeira etapa foi concluida e encaminhada para o funcionario!'
                ],200);
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
            ->leftjoin('companies as c','a.companies_id','=','c.id')
            ->leftjoin('location as l','a.location_id','=','l.id')
            ->leftjoin('user_data as ud','a.user_id_employee','=','ud.user_id')
            ->select(
                'ud.cpf',
                'ud.nasc',
                'ud.sexo',
                'u.name as funcionario',
                'c.nome',
                'a.type',
                'l.name as clinica',
                'l.cep',
                'l.endereco',
                'l.numero',
                'l.bairro',
                'l.cidade',
                'l.estado'
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
        }


        return view('vendor/voyager/index',['paciente' => $value,'filtro' => $filter]);
    }

    static function get_anamnese($filtro,$id){
        return  DB::table('anamnesis as a')
            ->leftjoin('companies as c','a.companies_id','=','c.id')
            ->select(
                'a.*',
                'c.nome',
                'c.cnpj'
            )
            ->where($filtro,$id)
            ->get();

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


    public function atestado($id){

        $anaminese = DB::table('anamnesis as a')
            ->join('companies as c','a.companies_id','=','c.id')
            ->join('users as u','a.user_id_employee','=','u.id')
            ->join('user_data as ud','ud.user_id','=','u.id')
            ->join('office as o','a.office_id','=','o.id')
            ->select(
                'a.apt',
                'a.id as anamnese_id',
                'a.user_id_examining_doctor',
                'a.message',
                'a.realization_date',
                'a.parecer',
                'a.type',
                'c.nome_fantasia',
                'c.cnpj',
                'c.endereco',
                'c.numero',
                'c.complemento',
                'c.bairro',
                'c.cidade',
                'c.uf',
                'u.id as user_id',
                'u.name as user_name',
                'u.email as user_email',
                'ud.cpf as user_cpf',
                'ud.rg as user_rg',
                'ud.nasc as user_nasc',
                'ud.idade as user_idade',
                'ud.sexo as user_sexo',
                'ud.estado_civil as user_estado_civil',
                'o.name as cargo',
                'o.id as cargo_id',
                'o.workplace as ambiente'
            )
            ->where('a.id',$id)
            ->get();


        return \PDF::loadView('atestado.atestado',['atestado' => $anaminese])
            ->setPaper('a4', 'portrait')
            ->save('storage/atestados/' . 'atestado-' . $anaminese[0]->user_name)
            ->stream('atestado-' . $anaminese[0]->user_name . '-' . rand(0,999999),array('Attachment'=>0));


//        return view('atestado.atestado',['atestado' => $anaminese]);
    }

    public function Complementar($id){
            $update = DB::table('anamnesis')
                ->where('id',$id)
                ->update([
                    'step' => 'step_complementar'
                ]);

        return response()->json([
            'success'=> true,
            'message'=> 'Anamnese aguardando como complementar!'
        ],200);


    }

    public function Complementarlist(){

        $doctor = (Auth::user()->role_id == 8) ? Auth::user()->parent : Auth::user()->id;

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
            ->where(['step'=>'step_complementar','user_id_examining_doctor' => $doctor])
            ->orderBy('a.id', 'desc')
            ->get();
        return view('anaminese.complementar',['anamnese' => $listagem]);
    }

    public function ComplementarStatus(Request $request,$id)
    {
        $a = $request->all();

        $update = DB::table('anamnesis')
            ->where('id',$id)
            ->update([
                'message' => $a['obs_geral'],
                'step' => 'step_med_p'
            ]);

        return response()->json([
            'success'=> true,
            'message'=> 'Encaminhado para medico com sucesso!'
        ],200);

    }

}

