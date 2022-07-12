<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CepTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cep', function (Blueprint $table) {
            $table->id();
            $table->integer('cep')->comment('cep'); 
            $table->string('uf', 2)->comment('Estado');            
            $table->string('localidade', 40)->comment('nome da cidade');
            $table->string('logradouro', 100)->comment('nome do logradouro');
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
        Schema::dropIfExists('cep');
    }
}
