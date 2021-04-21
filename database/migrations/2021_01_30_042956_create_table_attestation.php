<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAttestation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attestation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('companies_id');
            $table->unsignedBigInteger('user_id_employee'); // funcionario  cliente
            $table->unsignedBigInteger('user_id_logged'); // funcionario sso
            $table->unsignedBigInteger('anamnesis_id');
            $table->unsignedBigInteger('office_id');
            $table->unsignedBigInteger('products_id');
            $table->date('realization_date');
            $table->date('shelf_life');
            $table->text('look_like_doctor');
            $table->unsignedBigInteger('user_id_occupational_physician');
            $table->unsignedBigInteger('user_id_examining_doctor');
            $table->boolean('ureceived_duplicate');
            $table->timestamps();
        });

//        Schema::table('attestation', function($table) {
//            $table->foreign('companies_id')->references('id')->on('companies');
//            $table->foreign('user_id_employee')->references('id')->on('users');
//            $table->foreign('user_id_logged')->references('id')->on('users');
//            $table->foreign('anamnesis_id')->references('id')->on('anamnesis');
//            $table->foreign('office_id')->references('id')->on('office');
//            $table->foreign('products_id')->references('id')->on('products');
//            $table->foreign('user_id_occupational_physician')->references('id')->on('users');
//            $table->foreign('user_id_examining_doctor')->references('id')->on('users');
//        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attestation');
    }
}
