<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Office;
use App\RiskFactor;
use DB;
class OfficeController extends Controller
{

    public function store(Request $request){

        $cargo = [
            'name' => $request->input('name'),
            'workplace' => $request->input('workplace'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'created_at' => date('Y-m-d H:m:s')
        ];

         if($id = Office::create($cargo)){
             foreach ($request->risk as $key => $item) {
                 RiskFactor::risk($id,$item);
             }
         }

        return redirect('admin/office');
    }

    protected function update(Request $request)
    {
        $office_id = $request->input('office_id');
        $cargo = [
            'status'=> $request->input('status'),
            'name' => $request->input('name'),
            'workplace' => $request->input('workplace'),
            'description' => $request->input('description')
        ];
        if(Office::officeUpdate($office_id,$cargo)){
            RiskFactor::riskdelete($office_id);
            foreach ($request->risk as $key => $item) {
                RiskFactor::risk($office_id,$item);
            }
        }

        return redirect('admin/office');



    }

    public function getCargo(){
        $office = DB::table('office')
            ->select('id','name')
            ->get();

        return response()->json(['data' => $office]);

    }
    public function getrisco(Request $request){
        $cargo = $request->input('cargo');

        $risk = DB::table('office_risk_relationship as orr')
            ->leftjoin('risk_factors as rf','orr.risk_factors_id','=','rf.id')
            ->select('rf.id','rf.name')
            ->where('orr.office_id',$cargo)
            ->get();

        return response()->json(['data' => $risk]);

    }
    public function getallrisco(){

        $risk = DB::table('risk_factors')
            ->get();

        return response()->json(['data' => $risk]);

    }
}
