<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnAnamnesis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('anamnesis', function (Blueprint $table) {
//            $table->dropColumn('aparelho-auditivo-e-visual');
//            $table->dropColumn('cabeca-e-pescoco');
//            $table->dropColumn('aparelho-cardiorrespiratorio-e-vascular');
//            $table->dropColumn('torax-abdomen');
//            $table->dropColumn('coluna-vertebral');
//            $table->dropColumn('membros-superiores');
//            $table->dropColumn('membros-inferiores');
//            $table->dropColumn('pele-e-anexos');
//            $table->dropColumn('avaliacao-psiquiatrica');
//            $table->dropColumn('termo');
//            $table->dropColumn('aparelho-locomotor');
            $table->text('parecer')->nullable();
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
            $table->dropColumn('parecer');
        });
    }
}
