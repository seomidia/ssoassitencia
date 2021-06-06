<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use \App\User;
use DB;
use Illuminate\Support\Facades\Auth;
use Notification;
use Imagick;
use ImagickPixel;


class Anamnesi extends Model
{
    use Notifiable;


    protected function CreateImg($pdfPath,$imgPath){

        $imagick = new Imagick();
        $imagick->setResolution(140,140);
        $imagick->readImage($pdfPath['pathToPdf'] . $pdfPath['type']);
        $imagick->resizeImage(2480,3508,Imagick::FILTER_CUBIC,1);
        $imagick->setImageCompressionQuality(72);
        $imagick->setImageFormat(str_replace('.','',$imgPath['type']));
        if($imagick->writeImage($imgPath['imgPath'] . $imgPath['type'])){
           return [
               'success' => true,
               'message' => ''
           ];
        }

        return [
            'success'=> false,
            'messagem' => ''
        ];

    }
    protected function CreatePDF($anaminese,$pathToPdf,$name,$imgPath){

        $criatepdf =  \PDF::loadView('atestado.atestado',['atestado' => $anaminese])
            ->setPaper('a4', 'portrait')
            ->save($pathToPdf . '.pdf')
            ->stream($name  . '.pdf' ,array('Attachment'=>0));


        // criar imagem apartir do pdf --------------------

       $pdf = Anamnesi::CreateImg(
            [
                'pathToPdf' => $pathToPdf,
                'type'=> '.pdf'
            ] ,
            [
                'imgPath' => $imgPath,
                'type'=> '.png'
            ]
        );

       $img = Anamnesi::CreateImg(
            [
                'pathToPdf' => $imgPath,
                'type'=> '.png'
            ] ,
            [
                'imgPath' => $pathToPdf,
                'type'=> '.pdf'
            ]
        );

    }
    static function get_procedures($anamnese_id)
    {
        return DB::table('order_products as op')
            ->leftjoin('products as p', 'op.product_id', '=', 'p.id')
            ->leftjoin('exame_file as ef', 'op.product_id', '=', 'ef.exame_id')
            ->select('p.*','ef.*')
            ->where('op.anamnesis_id', $anamnese_id)
            ->get();

        // return DB::table('procedure_relationship as pr')
        // ->leftjoin('procedures as p', 'pr.procedures_id', '=', 'p.id')
        // ->select('p.*')
        // ->where('pr.anamnesis_id', $anamnese_id)
        // ->get();

    }
    static function get_risk($office_id)
    {
        return DB::table('office_risk_relationship as orr')
            ->join('risk_factors as rf', 'orr.risk_factors_id', '=', 'rf.id')
            ->select(
                'rf.name',
                'rf.description'
            )
            ->where('orr.office_id', $office_id)
            ->get();

    }
    protected function notification($user_id, $anamnese_id)
    {
        $result = DB::table('anamnesis as a')
            ->leftjoin('users as u', 'a.user_id_employee', '=', 'u.id')
            ->leftjoin('user_data as ud', 'a.user_id_employee', '=', 'ud.user_id')
            ->leftjoin('companies as c', 'a.companies_id', '=', 'c.id')
            ->leftjoin('location as l', 'a.location_id', '=', 'l.id')
            ->select(
                'u.name as paciente',
                'ud.cpf',
                'ud.nasc',
                'c.nome as empresa',
                'l.name as clinica',
                'l.cep',
                'l.endereco',
                'l.numero',
                'l.bairro',
                'l.cidade',
                'l.estado',
                'l.obs'
            )
            ->where('a.id', $anamnese_id)
            ->first();


        $job = [
            'paciente' => $result->paciente,
            'cpf' => $result->cpf,
            'nasc' => $result->nasc,
            'empresa' => $result->empresa,
            'clinica' => $result->clinica,
            'endereco' => $result->endereco . ' ' . $result->numero . ', ' . $result->bairro . ', ' . $result->cidade . ' - ' . $result->estado . ' ' . $result->obs,
        ];

        $user = User::find($user_id);
//        $user->notify(new \App\Notifications\encaminhamento());
        Notification::send($user, new \App\Notifications\encaminhamento($job));
    }
    public function updateAnamnese($data)
    {
        $data = [
            'realization_date' => $data['realization_date'],
            'apt' => $data['apt'],
            'user_id_examining_doctor' => $data['user_id_examining_doctor'],
            'message' => $data['message'],
        ];
    }
    protected function get_meta_question($anamnese_id, $question, $outros = null)
    {
        $meta = DB::table('meta_resposes')
            ->where(['anamnesis_id' => $anamnese_id, 'question' => $question])
            ->first();

            if(!is_null($outros)){
                $out = ($meta) ? $meta->response2 : '';
                return $out;
            }else{
                $data = ($meta) ? $meta->response : '';
                return $data;
            }
    }
    protected function procedure_disponivel($anamnese_id,$id){
        $total =  DB::table('order_products as op')
            ->join('orders as o','op.order_id','=','o.id')
            ->where(['o.user_id'=>Auth::user()->id,'op.product_id'=>$id,'op.status'=>0,'op.anamnesis_id'=>null])
            ->count(); // não disonivel

        return $total;
    }

    protected function procedure_use($anamnese_id,$id){
        $total =  DB::table('order_products as op')
        ->join('orders as o','op.order_id','=','o.id')
        ->where(['o.user_id'=>Auth::user()->id,'op.product_id'=>$id,'op.status'=>1,'op.anamnesis_id'=>$anamnese_id])
        ->count(); // nao disponivel para outras anamineses
        return $total;
    }
    protected function count_procedure($anamnese_id, $procedure_id = null)
    {
        $procedure =DB::table('procedure_relationship');
        if(!is_null($procedure_id)){
            $procedure = $procedure->where(['anamnesis_id' => $anamnese_id, 'procedures_id' => $procedure_id]);
        }else{
            $procedure = $procedure->where('anamnesis_id', $anamnese_id);
        }
        return $procedure->count();
    }
    protected function add_procedure($anamnese_id, $procedures, $updata = false)
    {
        if (!$updata) {
            foreach ($procedures as $key => $procedure) {
                if(isset($procedure->id)) $procedure = $procedure->id;
                $data = [
                    'anamnesis_id' => $anamnese_id,
                    'procedures_id' => $procedure,
                    'created_at' => date('Y-m-d H:i:s')
                ];

                DB::table('procedure_relationship')->insert($data);
            }
        } else {

            if (!empty($procedures)) {

                DB::table('procedure_relationship')
                    ->where('anamnesis_id', $anamnese_id)
                    ->delete();

                foreach ($procedures as $key => $procedure) {
                    DB::table('procedure_relationship')->insert([
                        'anamnesis_id' => $anamnese_id,
                        'procedures_id' => $procedure,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }
            } else {
                return [
                    'success' => false,
                    'message' => 'Informe o procedimento!'
                ];

            }

        }

    }
    protected function add_exame($exames){
        unset($exames->user_id_logged);
        unset($exames->requester);
        unset($exames->step);
        foreach ($exames->exames as $key => $exame) {
            $data = [
                'order_id' => $exames->order,
                'product_id' =>  $exame,
                'user_id' =>  Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s')
            ];
            $exist = \DB::table('exame')->where($data)->count();
            if($exist == 0)
               DB::table('exame')->insert($data);
        }
    }
    protected function add_meta_question(array $data, $question)
    {
        $from = [
            'user_id_employee' => $data['user_id_employee'],
            'anamnesis_id' => $data['anamnesis_id']
        ];

        if (isset($question['medico'])) {
            $from['section'] = 'medico';
        }

        $total = DB::table('meta_resposes')
            ->where($from)
            ->count();
        if ($total == 0 && !in_array('medico', $from)) {
            $this->create_meta_respose($question, $from);
        }

        if ($total == 0 && in_array('medico', $from)) {
            $this->create_meta_respose($question, $from);
        } else {
            $this->update_meta_respose($question, $from);
        }

    }
    protected function update_meta_respose($data, $from)
    {
        if (!in_array('medico', $from)) {
            foreach ($data as $key => $item) {
                if (is_array($item)) {
                    foreach ($item as $key2 => $per) {
                        $a['response'] = (is_array($per)) ? $per[0] : $per;
                        $a['response2'] = (is_array($per) && isset($per[1])) ? $per[1] : '';
                        $a['response3'] = (is_array($per) && isset($per[2])) ? $per[2] : '';
                        $a['updated_at'] = date('Y-m-d H:i:s');
                        DB::table('meta_resposes')
                            ->where(
                                [
                                    'user_id_employee' => $from['user_id_employee'],
                                    'anamnesis_id' => $from['anamnesis_id'],
                                    'section' => $key,
                                    'question' => $key2
                                ])
                            ->update($a);
                    }
                } else {
                    $d['response'] = $item;
                    $d['updated_at'] = date('Y-m-d H:i:s');
                    DB::table('meta_resposes')
                        ->where(
                            [
                                'user_id_employee' => $from['user_id_employee'],
                                'anamnesis_id' => $from['anamnesis_id'],
                                'section' => $key,
                                'question' => $key
                            ])
                        ->update($d);
                }
            }
        } else {
            foreach ($data as $key => $item) {
                $data['section'] = $key;

                if(is_Array($item)){
                    foreach ($item as $key2 => $per) {
                        $c['response'] = (is_array($per)) ? $per[0] : $per;
                        $c['response2'] = (is_array($per) && isset($per[1])) ? $per[1] : '';
                        $c['updated_at'] = date('Y-m-d H:i:s');
                        DB::table('meta_resposes')
                            ->where(
                                [
                                    'user_id_employee' => $from['user_id_employee'],
                                    'anamnesis_id' => $from['anamnesis_id'],
                                    'section' => 'medico',
                                    'question' => $key2
                                ])
                            ->update($c);
                        $dataA = [
                            'realization_date' => date('Y-m-d'),
                            'apt' => $item['status'],
                            'user_id_examining_doctor' => Auth::user()->id,
                            'parecer' => $item['parecer'],
                            'step' => 'step_med'
                        ];


                        $updade = DB::table('anamnesis')
                            ->where('id',$from['anamnesis_id'])
                            ->update($dataA);

                    }
                }
            }
        }
    }
    protected function create_meta_respose($data, $from)
    {
        if (!in_array('medico', $from)) {
            foreach ($data as $key => $item) {
                $a['user_id_employee'] = $from['user_id_employee'];
                $a['anamnesis_id'] = $from['anamnesis_id'];
                $a['section'] = $key;
                if (is_array($item)) {
                    foreach ($item as $key2 => $per) {
                        $a['question'] = $key2;
                        $a['response'] = (is_array($per)) ? $per[0] : $per;
                        $a['response2'] = (is_array($per) && isset($per[1])) ? $per[1] : '';
                        $a['response3'] = (is_array($per) && isset($per[2])) ? $per[2] : '';
                        $a['created_at'] = date('Y-m-d H:i:s');
                        DB::table('meta_resposes')->insert($a);
                    }
                } else {
                    $d['user_id_employee'] = $from['user_id_employee'];
                    $d['anamnesis_id'] = $from['anamnesis_id'];
                    $d['section'] = $key;
                    $d['question'] = $key;
                    $d['response'] = $item;
                    $d['created_at'] = date('Y-m-d H:i:s');
                    DB::table('meta_resposes')->insert($d);
                }
            }
        } else {
            foreach ($data as $key => $item) {
                $data['section'] = $key;

                if(is_Array($item)){
                    foreach ($item as $key2 => $per) {
                        $c['user_id_employee'] = $from['user_id_employee'];
                        $c['anamnesis_id'] = $from['anamnesis_id'];
                        $c['section'] = 'medico';
                        $c['question'] = $key2;
                        $c['response'] = (is_array($per)) ? $per[0] : $per;
                        $c['response2'] = (is_array($per) && isset($per[1])) ? $per[1] : '';
                        $c['created_at'] = date('Y-m-d H:i:s');
                        DB::table('meta_resposes')->insert($c);

                    }
                }
            }
        }
    }

    // create anamnesis ---------------------------------

    protected function CreateAnamnesi($data){

        $created = [
            'user_id_logged' => $data->user_id_logged,
            'user_id_employee' => $data->user_id_logged,
            'requester' => $data->requester,
            'step' => $data->step,
            'type' => $data->consulta->name,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $id =  DB::table('anamnesis')->insertGetId($created);

        return $id;

    }

    protected function ExameAnamnesiRelationship($exame,$anamnesi_id = null){

        if(!is_null($anamnesi_id)){
            $this->add_procedure($anamnesi_id,$exame);
        }else{
            $this->add_exame($exame);
        }
    }
}
