<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteColumnAnamnese extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('anamnesis', function (Blueprint $table) {
            $table->dropColumn('altura');
            $table->dropColumn('peso');
            $table->dropColumn('img');
            $table->dropColumn('pa');
            $table->dropColumn('fc');
            $table->dropColumn('fr');
            $table->dropColumn('obs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
