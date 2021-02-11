<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAnamineseQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anaminese_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anaminese_sessions_id');
            $table->string('description');
            $table->integer('parent');
            $table->timestamps();
        });

        Schema::table('anaminese_questions', function($table) {
            $table->foreign('anaminese_sessions_id')->references('id')->on('anaminese_sessions');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anaminese_questions');
    }
}
