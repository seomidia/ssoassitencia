<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsAnamnese extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('anamnesis', function (Blueprint $table) {
            $table->string('aparelho-auditivo-e-visual')->nullable();
            $table->string('cabeca-e-pescoco')->nullable();
            $table->string('aparelho-cardiorrespiratorio-e-vascular')->nullable();
            $table->string('aparelho-locomotor')->nullable();
            $table->string('torax-abdomen')->nullable();
            $table->string('coluna-vertebral')->nullable();
            $table->string('membros-superiores')->nullable();
            $table->string('membros-inferiores')->nullable();
            $table->string('pele-e-anexos')->nullable();
            $table->string('avaliacao-psiquiatrica')->nullable();
            $table->string('termo')->nullable();
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
            $table->dropColumn('aparelho-auditivo-e-visual');
            $table->dropColumn('cabeca-e-pescoco');
            $table->dropColumn('aparelho-cardiorrespiratorio-e-vascular');
            $table->dropColumn('aparelho-locomotor');
            $table->dropColumn('torax-abdomen');
            $table->dropColumn('coluna-vertebral');
            $table->dropColumn('membros-superiores');
            $table->dropColumn('membros-inferiores');
            $table->dropColumn('pele-e-anexos');
            $table->dropColumn('avaliacao-psiquiatrica');
            $table->dropColumn('termo');
        });
    }
}
