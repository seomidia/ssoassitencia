<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterRgUserData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_data', function (Blueprint $table) {
            $table->string('cpf')->nullable()->change();;
            $table->string('rg')->nullable()->change();
            $table->string('nasc')->nullable()->change();;
            $table->string('idade')->nullable()->change();;
            $table->string('sexo')->nullable()->change();;
            $table->string('estado_civil')->nullable()->change();;

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_data', function (Blueprint $table) {
            //
        });
    }
}
