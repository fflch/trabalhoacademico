<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('sitename');
            $table->text('rodape_site');
            $table->text('rodape_oficios');
            $table->text('importante_oficio');
            $table->text('declaracao');
            $table->text('mail_avaliacao');
            $table->text('mail_liberacao');
            $table->text('mail_devolucao');
            $table->text('mail_aprovacao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configs');
    }
}
