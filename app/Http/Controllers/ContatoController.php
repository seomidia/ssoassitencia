<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContatoController extends Controller
{
    public function index(){
        return view('contato');
    }
    public function send(Request $request){
        $data = new \stdClass();
        $data->nome = $request->input('nome');
        $data->sobrebome = $request->input('sobrenome');
        $data->emailTo = setting('site.email-gerente');
        $data->email = $request->input('email');
        $data->assunto = $request->input('assunto');
        $data->mensagem = $request->input('mensagem');

        $result = Mail::send(new \App\Mail\Sendcontato($data));

        return redirect('/contato');
    }

}
