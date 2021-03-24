<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOfficeRiskRelationship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office_risk_relationship', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('office_id');
            $table->unsignedBigInteger('risk_factors_id');
            $table->timestamps();
        });
        Schema::table('office_risk_relationship', function($table) {
            $table->foreign('office_id')->references('id')->on('office');
            $table->foreign('risk_factors_id')->references('id')->on('risk_factors');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('office_risk_relationship');
    }
}
