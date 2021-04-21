<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUserData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('cpf');
            $table->string('rg');
            $table->string('nasc');
            $table->string('idade');
            $table->string('sexo');
            $table->string('estado_civil');
            $table->timestamps();
        });

//        Schema::table('user_data', function($table) {
//            $table->foreign('user_id')->references('id')->on('users');
//        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_data');
    }
}
