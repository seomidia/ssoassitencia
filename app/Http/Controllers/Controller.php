<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use DB;
use Imagick;
use Illuminate\Support\Facades\Mail;
use App\Anamnesi;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    static function data($data){
        return date("d/m/Y", strtotime($data));
    }
    static function formatar_cpf_cnpj($doc) {
        $doc = preg_replace("/[^0-9]/", "", $doc);
        $qtd = strlen($doc);
        if($qtd >= 11) {
            if($qtd === 11 ) {
                $docFormatado = substr($doc, 0, 3) . '.' .
                    substr($doc, 3, 3) . '.' .
                    substr($doc, 6, 3) . '.' .
                    substr($doc, 9, 2);
            } else {
                $docFormatado = substr($doc, 0, 2) . '.' .
                    substr($doc, 2, 3) . '.' .
                    substr($doc, 5, 3) . '/' .
                    substr($doc, 8, 4) . '-' .
                    substr($doc, -2);
            }
            return $docFormatado;
        }else{
            return 'Documento invalido';
        }
    }

    public function sendmail($id){
        $anaminese = DB::table('anamnesis as a')
            ->join('users as u','a.user_id_employee','=','u.id')
            ->select(
                'u.name',
                'u.email'
            )
            ->where('a.id',$id)
            ->get();
        $file = storage_path('app/public/atestados/') . str_replace(' ','_',$anaminese[0]->name) .'/'. str_replace(' ','_',$anaminese[0]->name) .'-anamnese-'.$id.'.pdf';

        if(is_file($file)) {

            $data = new \stdClass();
            $data->name = $anaminese[0]->name;
            $data->email = $anaminese[0]->email;
            $data->conta = str_replace(' ', '_', $anaminese[0]->name);
            $data->anamnese = $id;
            $result = Mail::send(new \App\Mail\SendAtestado($data));
            if (is_null($result)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Atestado enviado para ' . $data->name . ' com sucesso!'
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Não foi possivel enviar o atestado!'
                ], 500);
            }
        }else{
            return response()->json([
                'success' => false,
                'message' => 'O arquivo nao esta disponivel no momento, clique no botão atestaso para criar.'
            ], 500);
        }
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

        $filename = str_replace(' ','_',$anaminese[0]->user_name) ;
        $pathAtestado    = storage_path('app/public/atestados');
        $pathAtestadoimg = storage_path('app/public/atestados/img');
        $pathAtestadoUser = storage_path('app/public/atestados/' . $filename);
        $pathAtestadoimgUser = storage_path('app/public/atestados/img/' . $filename);


        if(!is_dir($pathAtestado)){
            \File::makeDirectory($pathAtestado, $mode = 0777, true, true);
        }

        if(!is_dir($pathAtestadoimg)){
            \File::makeDirectory($pathAtestadoimg, $mode = 0777, true, true);
        }

        if(!is_dir($pathAtestadoUser)){
            \File::makeDirectory($pathAtestadoUser, $mode = 0777, true, true);
        }

        if(!is_dir($pathAtestadoimgUser)){
            \File::makeDirectory($pathAtestadoimgUser, $mode = 0777, true, true);
        }
        $name = $filename .'-anamnese-'. $id;
        $pathToPdf = $pathAtestadoUser . '/';
        $pathToPdf .= $name;

        $imgPath = $pathAtestadoimgUser . '/';
        $imgPath .= $name;

        if(!is_file($pathToPdf . '.pdf')){
            Anamnesi::CreatePDF($anaminese,$pathToPdf,$name,$imgPath);
            unlink($imgPath . '.png');
            rmdir($pathAtestadoimgUser);
        }

        return [
            'success' => true,
            'message' => 'PDF criado com sucesso!',
            'fileUri' => asset('storage/atestados/' . $filename .'/'. $name . '.pdf'),
            'existe' => $pathAtestadoimgUser
        ];
    }

}
