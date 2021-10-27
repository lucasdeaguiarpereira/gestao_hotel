<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->id();
            $table->dateTime('data_inicio');
            $table->dateTime('data_fim');
            $table->foreignId('id_visitante');
            $table->foreignId('id_responsavel');
            $table->foreignId('id_pacote');
            $table->foreignId('id_pesquisa_satisfacao');
            $table->bigInteger('qtd_pessoas');
            $table->bigInteger('status'); 
            $table->string('comentario');            
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
        Schema::dropIfExists('agendamentos');
    }
}
