<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableAgendamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agendamentos', function (Blueprint $table) {          
            $table->foreignId('id_responsavel')->nullable()->change();
            $table->foreignId('id_pacote')->nullable()->change();
            $table->foreignId('id_pesquisa_satisfacao')->nullable()->change();
            $table->bigInteger('qtd_pessoas')->nullable()->change();
            $table->string('comentario')->nullable()->change(); 
            $table->string('descricao')->nullable()->change(); 

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
