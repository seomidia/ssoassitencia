<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Office extends Model
{
    protected $table = 'office';

    protected $fillable = [
        'name', 'workplace', 'description','status'
    ];


    protected function create($data)
    {
        return DB::table('office')->insertGetId($data);
    }

    protected function officeUpdate($id,$data)
    {
        return ! DB::table('office')
            ->where('id',$id)
            ->update($data);
    }



}
