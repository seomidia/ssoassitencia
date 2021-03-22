<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Anamnesi extends Model
{

    protected function add_meta_question(array $data,$question)
    {
        $data = [
             'user_id_employee' => $data['user_id_employee'],
             'anamnesis_id' => $data['anamnesis_id']
         ];
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

            if(is_array($item)){
                foreach ($item as $key2 => $per) {
                    $data['question'] = $key2;
                    $data['response'] = (is_array($per)) ? $per[0] : $per;
                    $data['response2'] = (is_array($per) && isset($per[1])) ? $per[1] : '';
                    $data['response3'] = (is_array($per) && isset($per[2])) ? $per[2] : '';
                    $data['created_at'] = date('Y-m-d H:i:s');
                    if(!DB::table('meta_resposes')->insert($data)){
                        return [
                            'success'=> false,
                            'message'=> 'Não foi possivel cadastrar ' . $key2
                        ];
                    }
                }
            }
        }

        return [
            'success'=> true,
            'message'=> ''
        ];
    }

}
