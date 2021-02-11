<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAnaminese extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('anamnesis', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id_employee')->nullable()->change(); // funcionario  cliente
            $table->unsignedBigInteger('user_id_logged')->nullable()->change(); // funcionario sso
            $table->string('altura')->nullable()->change();
            $table->string('peso')->nullable()->change();
            $table->string('img')->nullable()->change();
            $table->string('pa')->nullable()->change();
            $table->string('fc')->nullable()->change();
            $table->string('fr')->nullable()->change();
            $table->text('obs')->nullable()->change();
            $table->date('realization_date')->nullable()->change();
            $table->boolean('apt')->nullable()->change();
            $table->unsignedBigInteger('user_id_examining_doctor')->nullable()->change();
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
