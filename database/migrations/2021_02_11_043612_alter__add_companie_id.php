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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('anamnesis', function (Blueprint $table) {
            $table->dropColumn('companies_id');
            $table->dropColumn('office_id');
            $table->dropColumn('ambiente_trabalho');

        });
    }
}
