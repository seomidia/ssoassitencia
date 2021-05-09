<?php

namespace App\Http\Controllers\Voyager;

use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\VoyagerAuthController as BaseVoyagerAuthController;

class VoyagerAuthController extends BaseVoyagerAuthController
{
    public function postLogin(Request $request)
    {

        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->credentials($request);

        if ($this->guard()->attempt($credentials, $request->has('remember'))) {
            $data_user = \DB::table('users as u')
            ->join('user_roles as ur','u.id','=','ur.user_id')
            ->select('ur.role_id')
            ->where('u.email',$credentials['email'])
            ->first();

            $origin = $request->input('originLogin');

            if(!is_null($data_user) && isset($origin)){
                return response()->json([
                    'autenticacao' => $this->sendLoginResponse($request),
                    'tipo_user' => $data_user->role_id
                ]);
            }
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.

        $this->incrementLoginAttempts($request);


        return $this->sendFailedLoginResponse($request);
    }

}
