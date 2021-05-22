<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use TCG\Voyager\Models\Role;
use DB;
use App\Notifications\invitePatient;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function UserCount($column = 'email',$value = null){
        if(is_null($value))
            return DB::table('users')->where($column,$value)->count();
    }

    protected  function User_register(array $data, $role_name = 'paciente')
    {
        $role = Role::where('name', $role_name)->firstOrFail();
        $total = DB::table('users')->where('email',$data['email'])->count();
        $totalcpf = DB::table('user_data')->where('cpf',$data['cpf'])->count();
        if($total == 0 && $totalcpf == 0){
                $user = \TCG\Voyager\Models\User::create([
                    'name'           => $data['nome'],
                    'email'          => $data['email'],
                    'password'       => $data['password'],
                    'remember_token' => Str::random(60)
                ]);
//                role adcional -------------------------
            DB::table('users')->where(['id'=>$user->id])->update(['role_id'=>4]);
            DB::table('user_roles')->insert(['user_id'=>$user->id,'role_id'=> $role->id]);
            if(isset($user->id)){

                if($role_name == 'paciente'){
                     //notification -------------------------

                    $user->notify(new \App\Notifications\invitePatient());
                }

                return [
                    'success'=> true,
                    'data' => [
                        'user_id' => $user->id
                    ],
                    'message'=> ''
                ];
            }else{
                return [
                    'success'=> false,
                    'message'=> 'Erro interne: ' . $user
                ];
            }

        }else{
            return [
                'success'=> false,
                'message'=> 'Usuário já esta cadastrado!'
            ];
        }

    }
}
