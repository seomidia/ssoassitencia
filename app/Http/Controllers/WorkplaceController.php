<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class WorkplaceController extends Controller
{

    public function getworkplace(){
        $workplace = DB::table('Workplace')
            ->select('id','name')
            ->get();

        return response()->json(['data' => $workplace]);
    }

}
