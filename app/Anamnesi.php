<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use \App\User;
use DB;
use Illuminate\Support\Facades\Auth;

class Anamnesi extends Model
{
    use Notifiable;

    static function get_procedures($anamnese_id){
        return DB::table('procedure_relationship as pr')
            ->join('procedures as p','pr.procedures_id','=','p.id')
            ->select('p.name','p.description')
            ->where('pr.anamnesis_id',$anamnese_id)
            ->get();

    }

    static function get_risk($office_id){
        return DB::table('office_risk_relationship as orr')
            ->join('risk_factors as rf','orr.risk_factors_id','=','rf.id')
            ->select(
                'rf.name',
                'rf.description'
            )
            ->where('orr.office_id',$office_id)
            ->get();

    }


    protected function notification($id){
        $user = User::find($id);
        $user->notify(new \App\Notifications\encaminhamento());
    }

    public function updateAnamnese($data){
        $data = [
            'realization_date' => $data['realization_date'],
            'apt' => $data['apt'],
            'user_id_examining_doctor' => $data['user_id_examining_doctor'],
            'message' => $data['message'],
        ];
    }

    protected function get_meta_question($anamnese_id,$question){
        $meta = DB::table('meta_resposes')
            ->where(['anamnesis_id'=>$anamnese_id,'question'=>$question])
            ->get();

        $data = (count($meta) > 0) ? $meta[0]->response : '';

        return $data;
    }
    protected function count_procedure($anamnese_id,$procedure_id)
    {
        return DB::table('procedure_relationship')
            ->where(['anamnesis_id' => $anamnese_id,'procedures_id'=>$procedure_id])
            ->count();
    }
        protected function add_procedure($anamnese_id,$procedures,$updata = false){
        if(!$updata){
            foreach ($procedures as $key => $procedure) {
               DB::table('procedure_relationship')->insert([
                   'anamnesis_id' => $anamnese_id,
                   'procedures_id' => $procedure,
                   'created_at' => date('Y-m-d H:i:s')
               ]);
            }
        }else{

            DB::table('procedure_relationship')
                ->where('anamnesis_id',$anamnese_id)
                ->delete();

            foreach ($procedures as $key => $procedure) {
                DB::table('procedure_relationship')->insert([
                    'anamnesis_id' => $anamnese_id,
                    'procedures_id' => $procedure,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }

        }

    }
    protected function add_meta_question(array $data,$question,$updata = true)
    {
        $data = [
             'user_id_employee' => $data['user_id_employee'],
             'anamnesis_id' => $data['anamnesis_id']
         ];

        if($updata){
            if(!isset($question['medico'])){
            $data['section'] = 'biotipo';
            $data['question'] = 'biotipo';
            $data['response'] = $question['biotipo'];
                if(!DB::table('meta_resposes')->insert($data)){
                    return [
                        'success'=> false,
                        'message'=> 'Não foi possivel cadastrar biotipo'
                    ];
                }
            }
            if(isset($question['medico']) && !isset($question['medico']['parecer_medico'])) {
                $status = $question['medico']['status'];
            }
            unset($question['medico']['procedure']);
            foreach ($question as $key => $item) {
                $data['section'] = $key;

                if (is_array($item)) {
                    foreach ($item as $key2 => $per) {
                        $data['question'] = $key2;
                        $data['response'] = (is_array($per)) ? $per[0] : $per;
                        $data['response2'] = (is_array($per) && isset($per[1])) ? $per[1] : '';
                        $data['response3'] = (is_array($per) && isset($per[2])) ? $per[2] : '';
                        $data['created_at'] = date('Y-m-d H:i:s');

                       DB::table('meta_resposes')->insert($data);
                        if(isset($question['medico']) && !isset($question['medico']['parecer_medico'])) {
                            $dataA = [
                                'realization_date' => date('Y-m-d'),
                                'apt' => $status,
                                'user_id_examining_doctor' => Auth::user()->id,
                                'message' => $question['medico']['obs'],
                            ];


                            $updade = DB::table('anamnesis')
                                ->where('id', $data['anamnesis_id'])
                                ->update($dataA);
                        }
                    }
                }
            }

        }else{
            foreach ($question as $key => $item) {

                $data['section'] = $key;

                if (is_array($item)) {
                    foreach ($item as $key2 => $per) {
                        $data['question'] = $key2;
                        $data['response'] =  $per;
                        $data['created_at'] = date('Y-m-d H:i:s');

                        $Count = DB::table('meta_resposes')
                            ->where('anamnesis_id',$data['anamnesis_id'])
                            ->count();
                        if($Count <= 70){
                            if (!DB::table('meta_resposes')->insert($data)) {
                                return [
                                    'success' => false,
                                    'message' => 'Não foi possivel cadastrar '
                                ];
                            }
                            $dataA = [
                                'realization_date' => date('Y-m-d'),
                                'apt' => $question['medico']['status'],
                                'user_id_examining_doctor' => Auth::user()->id,
                                'message' => $question['medico']['obs'],
                            ];


                            $updade = DB::table('anamnesis')
                                ->where('id',$data['anamnesis_id'])
                                ->update($dataA);
                        }else{
                            if (!DB::table('meta_resposes')->where(['anamnesis_id'=>$data['anamnesis_id'],'section' => $key,'question' => $key2])->update($data)) {
                                return [
                                    'success' => false,
                                    'message' => 'Não foi possivel cadastrar '
                                ];
                            }
                            $dataA = [
                                'realization_date' => date('Y-m-d'),
                                'apt' => $question['medico']['status'],
                                'user_id_examining_doctor' => Auth::user()->id,
                                'message' => $question['medico']['obs'],
                            ];


                            $updade = DB::table('anamnesis')
                                ->where('id',$data['anamnesis_id'])
                                ->update($dataA);                        }
                    }
                }
            }
        }
        return [
            'success'=>true,
            'message'=>''
        ];
    }

}
