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
        $cpf = preg_replace('/[^0-9]/', '', $data['cpf']);
        $role = Role::where('name', $role_name)->firstOrFail();
        $total = DB::table('users')->where('email',$data['email'])->count();
        $totalcpf = DB::table('user_data')->where('cpf',$cpf)->count();

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
                        'method' => 'create',
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
            $userU = DB::table('user_data')
            ->select('user_id')
            ->where('cpf',$cpf)
            ->first();

            unset($data['password']);

            $userd = [
                'name'           => $data['nome'],
                'email'          => $data['email'],
            ];

            DB::table('users')->where(['id'=>$userU->user_id])->update($userd);

            return [
                'success'=> true,
                'data' => [
                    'method' => 'update',
                    'user_id' => $userU->user_id,
                ],
            'message'=> 'Usuário atualizado com sucesso!'
            ];
        }

    }
}
