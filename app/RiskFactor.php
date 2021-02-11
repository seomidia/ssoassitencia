<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\OfficeRiskRelationship;
use DB;
class RiskFactor extends Model
{



    protected function risk($office_id,$risk_factors_id)
    {
        return DB::table('office_risk_relationship')->insert([
            'office_id' => $office_id,
            'risk_factors_id' => $risk_factors_id,
            'created_at' => date('Y-m-d H:m:s')
        ]);

    }

    protected function riskdelete($id)
    {
           return OfficeRiskRelationship::where('office_id',$id)
                ->delete();
    }

}
