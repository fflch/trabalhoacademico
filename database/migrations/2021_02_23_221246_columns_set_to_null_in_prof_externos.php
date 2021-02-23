<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ColumnsSetToNullInProfExternos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prof_externos', function (Blueprint $table) {
            $table->string('cpf')->nullable()->change();
            $table->string('rg')->nullable()->change();
            $table->string('instituicao')->nullable()->change();
            $table->string('email')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prof_externos', function (Blueprint $table) {
            //
        });
    }
}
