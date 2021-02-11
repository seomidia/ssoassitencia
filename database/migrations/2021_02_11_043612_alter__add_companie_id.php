<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddCompanieId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('anamnesis', function (Blueprint $table) {
            $table->unsignedBigInteger('companies_id')->nullable();
            $table->unsignedBigInteger('office_id')->nullable();
            $table->string('ambiente_trabalho')->nullable();
        });

        Schema::table('anamnesis', function($table) {
            $table->foreign('companies_id')->references('id')->on('companies');
            $table->foreign('office_id')->references('id')->on('office');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('anamnesis', function (Blueprint $table) {
            //
        });
    }
}
