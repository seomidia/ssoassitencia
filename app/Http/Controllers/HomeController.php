<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cat = DB::table('categories as c')
            ->join('products as p','c.id','=','p.category_id')
            ->select('c.name as categoria','p.*')
            ->get();

        $colection = collect($cat)
            ->groupBy('categoria')
            ->map(function ($item) {
                return array_merge($item->toArray());
            });


        return view('home',['categoria'=> $colection]);
    }

    public function sobrenos()
    {
        $datapage = DB::table('pages')
            ->where('slug','sobre-nos')
            ->get();

        return view('pages',['datapage'=>$datapage]);
    }
    public function politicadeprivacidade()
    {
        $datapage = DB::table('pages')
            ->where('slug','politica-de-privacidade')
            ->get();

        return view('pages',['datapage'=>$datapage]);
    }
    public function parceiros()
    {
        $datapage = DB::table('pages')
            ->where('slug','parceiros')
            ->get();

        return view('pages',['datapage'=>$datapage]);
    }
    public function trabalheconosco()
    {
        return view('trabalheconosco');
    }
    public function trabalheEnvia(Request $request)
    {
        // Define o valor default para a variável que contém o nome da imagem
        $nameFile = null;

        // Verifica se informou o arquivo e se é válido
        if ($request->hasFile('arquivo') && $request->file('arquivo')->isValid()) {

            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));

            // Recupera a extensão do arquivo
            $extension = $request->arquivo->extension();

            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";

            // Faz o upload:
            $upload = $request->arquivo->storeAs('/temp', $nameFile);
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/temp/nomedinamicoarquivo.extensao

            // Verifica se NÃO deu certo o upload (Redireciona de volta)
            if ( !$upload ){
                return redirect()
                    ->back()
                    ->with('error', 'Falha ao fazer upload')
                    ->withInput();
            }
            $data = new \stdClass();
            $data->nome = $request->input('nome');
            $data->sobrebome = $request->input('sobrenome');
            $data->emailTo = setting('site.email-gerente');
            $data->email = $request->input('email');
            $data->telefone = $request->input('tel');
            $data->arquivo = $upload;

            $result = Mail::send(new \App\Mail\Sendtrabalheconosco($data));

            return redirect('/trabalhe-conosco');
        }


    }

}
