<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use TCG\Voyager\Models\Role;
use DB;
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

    protected  function User_register(array $data, $role_name = 'paciente')
    {
        $role = Role::where('name', $role_name)->firstOrFail();

        $total = DB::table('users')->where('email',$data['email'])->count();
        if($total == 0){
                $user = \TCG\Voyager\Models\User::create([
                    'name'           => $data['nome'],
                    'email'          => $data['email'],
                    'password'       => bcrypt($data['password']),
                    'remember_token' => Str::random(60),
                    'role_id'        => 4,
                ]);
//                role adcional -------------------------
            DB::table('user_roles')->insert(['user_id'=>$user->id,'role_id'=> $role->id]);
            if(isset($user->id)){
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
