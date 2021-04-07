<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;
use \App\User;
use \Auth;

class UserController extends Controller
{

    public function Assistente(){
        $list = DB::table('users')
            ->where('parent',Auth::user()->id)
            ->get();

        return view('assistente.listagem',['users' => $list]);
    }

    public function AssistenteCreate(){
        return view('assistente.form');
    }

    public function AssistenteEdit($id){
        $user = DB::table('users')
            ->select('name','email')
            ->where('id',$id)
            ->get();
        return view('assistente.form',[
            'name' => $user[0]->name,
            'email' => $user[0]->email,
            'id' => $id
        ]);
    }

    public function AssistenteStore(Request $request){

        $data = $request->all();
        $exist = User::UserCount('email',$data['email']);

        if($exist == 0){
            $user = \TCG\Voyager\Models\User::create([
                'name'           => $data['name'],
                'email'          => $data['email'],
                'password'       => bcrypt($data['password']),
                'parent'       => $data['parent'],
                'remember_token' => Str::random(60),
                'role_id'        => 8,
            ]);
            DB::table('user_roles')->insert(['user_id'=>$user->id,'role_id'=> 8]);

            return response()->json([
                'status' => true,
                'message' => "Assistente cadastrado com sucesso!"
            ],201);
        }else{
            return response()->json([
                'status' => false,
                'message' => "O e-mail de assistente já esta sendo usado por outro usuario!"
            ],500);
        }


    }
    public function AssistenteUpdate(Request $request,$id){

        $data = $request->all();
        $exist = User::UserCount('id',$id);

        if($exist > 0){
            $senha = $request->input('password');
            $data = [
                'name' => $request->input('name'),
                'email' => $request->input('email')
            ];

            if($senha != '')   $data['password']= bcrypt($senha);

            $update = DB::table('users')
                ->where('id',$id)
                ->update($data);
            return response()->json([
                'status' => true,
                'message' => "Assistente atualizado com sucesso!"
            ],200);
        }else{
            return response()->json([
                'status' => false,
                'message' => "Este usuario não existe!"
            ],500);
        }


    }
    public function assistenteDelete($id){
        $delete = DB::table('users')
            ->where('id',$id)
            ->delete();

        if($delete){
            return response()->json([
                'status' => false,
                'message' => "Assistente removido com sucesso!"
            ],200);
        }else{
            return response()->json([
                'status' => false,
                'message' => "Não foi possivel remover o assistentes!"
            ],500);
        }
    }


    public function getMedico()
    {
        $office = DB::table('user_roles')
            ->join('users', 'user_roles.user_id', '=', 'users.id')
            ->where('user_roles.role_id',6)
            ->select('users.id', 'users.name')
            ->get();

        return response()->json(['data' => $office]);

    }
}
