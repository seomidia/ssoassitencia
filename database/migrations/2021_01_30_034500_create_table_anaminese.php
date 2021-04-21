<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAnaminese extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anamnesis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id_employee'); // funcionario  cliente
            $table->unsignedBigInteger('user_id_logged'); // funcionario sso
            $table->string('altura');
            $table->string('peso');
            $table->string('img');
            $table->string('pa');
            $table->string('fc');
            $table->string('fr');
            $table->text('obs');
            $table->date('realization_date');
            $table->boolean('apt');
            $table->unsignedBigInteger('user_id_examining_doctor');
            $table->timestamps();
        });

//        Schema::table('anamnesis', function($table) {
//            $table->foreign('user_id_employee')->references('id')->on('users');
//            $table->foreign('user_id_logged')->references('id')->on('users');
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
        Schema::dropIfExists('anamnesis');
    }
}
