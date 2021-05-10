<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Product extends Model
{

    protected function get_product(array $prod){
        $ids = [];
        for ($i = 0; $i < count($prod); $i++){
            $ids[] = $prod[$i]['product_id'];
        }

        $query = DB::table('products')
                 ->select('id','name','image','slug','price', 'sale')
                 ->wherein('id',$ids)
                 ->orderBy('id','DESC')
                 ->get();
        foreach ($query as $key => $item){
            $products[]   = [
            'id'=> $item->id,
            'name'=> $item->name,
            'image'=> $item->image,
            'slug'=> $item->slug,
            'price'=> $item->price,
            'sale'=> $item->sale,
            'qtd'=> $prod[$key]['qtd']
            ];
        }

        return $products;

    }

    protected function getConsulta($id){
        $consulta = DB::table('products')
            ->where('id',$id)
            ->first();

        if(isset($consulta->category_id) && in_array($consulta->category_id,[3,6]))
            return $consulta;
    }
    protected function getExames($id){
        $consulta = DB::table('products')
            ->select('id','category_id')
            ->where('id',$id)
            ->first();

        if(isset($consulta->category_id) && in_array($consulta->category_id,[4,5,7,8])){
            unset($consulta->category_id);
            return $consulta;
        }
    }
    protected function CreateService($data){


        $products = DB::table('order_products')
            ->where('order_id',$data->idOrder)->get();

        $servico = new \stdClass();
        $servico->user_id_logged = $data->useridOrder;
        $servico->requester = $data->useridOrder;
        $servico->step = 'step_site';

        foreach ($products as $key => $product){
            if(!is_null($this->getConsulta($product->product_id)))
                $servico->consulta = $this->getConsulta($product->product_id);

            if(!is_null($this->getExames($product->product_id))){
                $servico->exames[] = $this->getExames($product->product_id);
            }
        }

        if(!empty($servico->consulta)){
            $anamnesi_id = \App\Anamnesi::CreateAnamnesi($servico);
        }


        if(!empty($servico->exames)){
            if(isset($anamnesi_id)){
                \App\Anamnesi::ExameAnamnesiRelationship($servico->exames,$anamnesi_id);
            }else{
                $servico->order = $data->idOrder;
                \App\Anamnesi::ExameAnamnesiRelationship($servico);
            }
        }


    }

    protected function CreateAnamnesi(){
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

    }
}
