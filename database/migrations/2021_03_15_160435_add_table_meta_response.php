<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableMetaResponse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta_resposes', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id_employee');
            $table->integer('anamnesis_id');
            $table->string('section');
            $table->string('question')->nullable();
            $table->string('response')->nullable();
            $table->string('response2')->nullable();
            $table->string('response3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meta_resposes');
    }
}
