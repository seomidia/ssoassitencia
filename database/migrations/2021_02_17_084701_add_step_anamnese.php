<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStepAnamnese extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('anamnesis', function (Blueprint $table) {
            $table->string('step');
            $table->integer('requester');
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
            $table->dropColumn('step');
            $table->dropColumn('requester');
        });
    }
}
