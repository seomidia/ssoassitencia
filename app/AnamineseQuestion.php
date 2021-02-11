<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class AnamineseQuestion extends Model
{

    protected function create($data)
    {
        return DB::table('anaminese_questions')->insert($data);
    }

    protected function QuestionUpdate($id,$data)
    {

        return DB::table('anaminese_questions')
            ->where('id',$id)
            ->update($data);
    }



}
