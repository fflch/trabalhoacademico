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
            $table->increments('id');
            $table->timestamps();
            $table->integer('codpes'); # remover
            $table->string('nome'); # remover
            $table->string('e_mail_usp'); # remover
            $table->string('outro_recomendado_')->nullable();
            $table->string('divulgar_e_mail_');
            $table->string('titulo');
            $table->text('resumo');
            $table->string('palavras_chave');
            $table->text('abstract')->nullable();
            $table->date('data_da_defesa');
            $table->string('nome_do_orientador');
            $table->string('numero_usp_do_orientador');
            $table->string('co_orientador');
            $table->string('status');

            # Vou deixar comentado
            #$table->foreignId('user_id')->constrained('users');
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
