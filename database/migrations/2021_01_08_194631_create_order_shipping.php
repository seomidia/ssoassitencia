<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderShipping extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_shipping', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('companies_id');
            $table->string('name');
            $table->string('sobrenome');
            $table->string('empresa');
            $table->string('endereco');
            $table->string('complemento');
            $table->string('uf');
            $table->string('cep');
            $table->string('email');
            $table->string('telefone');
            $table->string('obs');
            $table->string('card_number');
            $table->string('card_validate');
            $table->string('cvv');
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
        Schema::dropIfExists('order_shipping');
    }
}
