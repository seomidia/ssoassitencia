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
    public function dia($num){
        switch ($num){
            case '1':
                return 'Segunda-feira';
                break;
            case '2':
                return 'Terça-feira';
                break;
            case '3':
                return 'Quarta-feira';
                break;
            case '4':
                return 'Quinta-feira';
                break;
            case '5':
                return 'Sexta-feira';
                break;
            case '6':
                return 'Sabado';
                break;
            case '0':
                return 'Domingo';
                break;
        }
    }
    public function getSemana($data){
        $data = date("Y-m-d", strtotime($data));
        $semMes2 = date("w", strtotime($data));

        return $this->dia($semMes2);
    }
    public function getLocal(Request $request){
        $cidade = $request->input('cidade');
        $estado = $request->input('uf');

        $local = DB::table('location')
            ->select('*')
            ->where(['cidade'=> $cidade,'estado'=>$estado])
            ->get();

        return $local;
    }
    public function getDias(){
        $semMes2 = date("w", strtotime(date("Y-m-d")));
        $dia = date('d');
        if($semMes2 >=1 && $semMes2 <=5){
            $total = 5 - $semMes2;

            for ($i = 0;$i <= $total; $i++){
                $datas[] = [
                    'data' => date('d') + $i . '-' . date('m') . '-' . date('Y'),
                    'dia'  => $this->dia($semMes2 + $i)
                ];
            }

            if($semMes2 == 5){
                $total = 5 - 1;
                $dia = $dia + 3;
                for ($i = 0; $i <= $total; $i++) {
                    $datas[] = [
                        'data' => $dia + $i . '-' . date('m') . '-' . date('Y'),
                        'dia'  => $this->dia($semMes2 + $i)
                    ];
                }

            }
        }else {
            $total = 5 - 1;
            $dia = $dia + 2;
            for ($i = 0; $i <= $total; $i++) {
                $datas[] = [
                    'data' => $dia + $i . '-' . date('m') . '-' . date('Y'),
                    'dia'  => $this->dia($semMes2 + $i)
                ];
            }
        }
        return response()->json([
            'success' => true,
            'data' => $datas,
            'message' => ''
        ],200);
    }
    //  feedback medico ----------------------------------------------
    public function feedbackMedico(Request $request){


        $user        = $request->input('employee');
        $anamnese_id = $request->input('anamnese');
        $photo = $request->input('photo_employee');
        DB::table('anamnesis')
        ->where('id',$anamnese_id)
        ->update(['user_id_examining_doctor'=>Auth::user()->id]);
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
                // agendamento ---------------------------------------------------------------
                $agendamento = [
                    'status' => 3,
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                $agenda = DB::table('schedule')->where('anamnesis_id',$anamnese_id)->update($agendamento);

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

        $order = DB::table('orders as o')
            ->join('order_products as op','o.id','=','op.order_id')
            ->join('products as p','op.product_id','=','p.id')
            ->select(
                'o.id',
                'p.name',
                'o.payment_type',
                'o.code',
                'p.price',
                'o.status',
                'o.created_at'
            )
            ->where('user_id',Auth::user()->id)
            ->wherein('o.status',['Paga','pending','Aguardando pagamento','Devolvida'])
            ->get();

        return view('anaminese.listagem',['anamnese' => $listagem,'orders' => $order]);
    }
    public function cadastro($id){
        $user_logged = Auth::user()->id;
        $dados = DB::table('anamnesis as a')
        ->leftjoin('companies as c','a.companies_id','=','c.id')
        ->leftjoin('users as u','a.user_id_employee','=','u.id')
        ->leftjoin('user_data as ud','a.user_id_employee','=','ud.user_id')
        ->leftjoin('office as o','a.office_id','=','o.id')
        ->leftjoin('schedule as s','a.id','=','s.anamnesis_id')
        ->select(
            'a.*',
            'c.*',
            'ud.rg',
            'ud.cpf',
            'ud.nasc',
            'ud.idade',
            'ud.sexo',
            'u.name as funcionario',
            'o.name as cargo',
            's.day',
            's.time'
        )
            ->where(['a.id'=>$id,'a.user_id_logged'=>Auth::user()->id])
            ->get();

//        $procedures = DB::table('procedures')->get();

        $procedures = DB::table('order_products as op')
            ->join('products as p','op.product_id','=','p.id')
            ->join('orders as o','op.order_id','=','o.id')
            ->select(
                'p.id',
                'p.name',
                'op.status',
                'op.product_id',
                'op.anamnesis_id',
                'p.slug'
            )
            ->wherein('p.category_id',[4,5,7,8])
            ->where('o.user_id',Auth::user()->id)
            ->get();


        $tipo = DB::table('anamnese_type')->get();
        $riscos = DB::table('office_risk_relationship as orr')
            ->join('risk_factors as rf','orr.risk_factors_id','=','rf.id')
            ->select('rf.id','rf.name')
            ->where('orr.anamnesi_id',$id)
            ->get();
        $locais = DB::table('location')->where('id',$dados[0]->location_id )->get();
        return view('anaminese.update',[
            'anamnese_id' => $id,
            'user_logged' => $user_logged,
            'dados'=> $dados,
            'procedures' => $procedures,
            'tipo' => $tipo,
            'locais' => $locais,
            'riscos' => $riscos
        ]);
    }
    public function create(Request $request){

        $id =  DB::table('anamnesis')->insertGetId([
            'user_id_logged' => Auth::user()->id,
            'requester' => Auth::user()->id,
            'step' => 'step_rh',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $agendamento = [
            'anamnesis_id' => $id,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $agendamento = DB::table('schedule')->insert($agendamento);

  return $id;
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

            $pessoad = [
                'cpf' => str_replace(['.','-'],['',''],$request->input('pessoa_cpf')),
                'rg' => $request->input('pessoa_rg'),
                'nasc' => $request->input('pessoa_nascimento'),
                'idade' => $request->input('pessoa_idade'),
                'sexo' => $request->input('pessoa_sexo')
            ];

            $pessoa = DB::table('user_data')->where('user_id',$func);
            $user_data = $pessoa->first();
            foreach ($user_data as $key => $item) {
                if($item == '' && $key != 'created_at' && $key != 'updated_at')
                    return response()->json([
                        'success'=> false,
                        'message'=> 'Não é possivel vincular para esta pessoal, pois seu cadastro esta incompleto!'
                    ],500);

            }




            $update_pessoa = $pessoa->update($pessoad);


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
            if(!is_null($request->medico['procedure'])){
                $ehcreate = DB::table('anamnesis')
                    ->where('id',$id)
                    ->wherein('step',['step_rh','step_funci'])
                    ->count();
                if($ehcreate == 1){
                    Anamnesi::add_procedure($id,$request->medico['procedure']);
                }else{
                    Anamnesi::add_procedure($id,$request->medico['procedure'],true);
                }

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

             $agendamento = [
                 'user_id_employee' => $func,
                 'day' => date("Y-m-d", strtotime($request->input('diames'))),
                 'time' => $request->input('hora'),
                 'status' => 1,
                 'updated_at' => date('Y-m-d H:i:s')
             ];
            $agenda = DB::table('schedule')->where('anamnesis_id',$id)->update($agendamento);

            $updade = DB::table('anamnesis')
                ->where('id',$id)
                ->update($data);

            // atualiza riscos -----------------------------------------
              // checar se existe riscos -------------------------------
                    $Risk = DB::table('office_risk_relationship');
                    if($Risk->where('anamnesi_id',$id)->count() > 0){
                        $Risk->where('anamnesi_id',$id)->delete();
                        foreach ($request->riscos as $risco) {
                            $r = [
                                'risk_factors_id' => $risco,
                                'anamnesi_id'=>$id,
                                'created_at'=> date('Y-m-d H:i:s')
                            ];
                            $Risk->insert($r);

                        }
                    }else{
                        foreach ($request->riscos as $risco) {
                            $r = [
                                'risk_factors_id' => $risco,
                                'anamnesi_id'=>$id,
                                'created_at'=> date('Y-m-d H:i:s')
                            ];
                            $Risk->insert($r);

                        }
                    }




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

