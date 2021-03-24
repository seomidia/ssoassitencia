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


//        $updade = DB::table('anamnesis')
//            ->where('id',$id)
//            ->update($data);
    }

    protected function add_meta_question(array $data,$question,$updata = true)
    {
        $data = [
             'user_id_employee' => $data['user_id_employee'],
             'anamnesis_id' => $data['anamnesis_id']
         ];
        if($updata){
                $data['section'] = 'biotipo';
                $data['question'] = 'biotipo';
                $data['response'] = $question['biotipo'];
                    if(!DB::table('meta_resposes')->insert($data)){
                        return [
                            'success'=> false,
                            'message'=> 'Não foi possivel cadastrar biotipo'
                        ];
                    }

                foreach ($question as $key => $item) {
                    $data['section'] = $key;

                    if (is_array($item)) {
                        foreach ($item as $key2 => $per) {
                            $data['question'] = $key2;
                            $data['response'] = (is_array($per)) ? $per[0] : $per;
                            $data['response2'] = (is_array($per) && isset($per[1])) ? $per[1] : '';
                            $data['response3'] = (is_array($per) && isset($per[2])) ? $per[2] : '';
                            $data['created_at'] = date('Y-m-d H:i:s');
                            if (!DB::table('meta_resposes')->insert($data)) {
                                return [
                                    'success' => false,
                                    'message' => 'Não foi possivel cadastrar ' . $key2
                                ];
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
                        }else{
                            if (!DB::table('meta_resposes')->where(['anamnesis_id'=>$data['anamnesis_id'],'section' => $key,'question' => $key2])->update($data)) {
                                return [
                                    'success' => false,
                                    'message' => 'Não foi possivel cadastrar '
                                ];
                            }
                        }
                    }
                }
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


        }

        return [
            'success'=> true,
            'message'=> ''
        ];
    }

}
