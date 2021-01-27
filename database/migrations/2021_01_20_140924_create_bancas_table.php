<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBancasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bancas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('codpes');
            $table->string('nome')->nullable();

            #$table->integer('agendamento_id')->unsigned();
            #$table->foreign('agendamento_id')->references('id')->on('agendamentos');

            $table->foreignId('agendamento_id')->constrained('agendamentos');

            $table->string('presidente');
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
        Schema::dropIfExists('bancas');
    }
}
