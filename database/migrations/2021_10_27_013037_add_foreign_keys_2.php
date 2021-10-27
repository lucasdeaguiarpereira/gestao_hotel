<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeys2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('endereco_usuario', function (Blueprint $table) {        
            $table->foreign('id_usuario')->references('id')->on('users');
        });

        Schema::table('agendamentos', function (Blueprint $table) {        
            $table->foreign('id_visitante')->references('id')->on('users');
            $table->foreign('id_responsavel')->references('id')->on('users');
            $table->foreign('id_pacote')->references('id')->on('pacotes');
            $table->foreign('id_pesquisa_satisfacao')->references('id')->on('pesquisa_satisfacao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
