<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
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
