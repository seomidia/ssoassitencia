<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAnamineseResponses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anaminese_responses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anaminese_questions_id');
            $table->unsignedBigInteger('anamnesis_id');
            $table->boolean('response')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('anaminese_responses');
    }
}
