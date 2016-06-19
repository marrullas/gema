<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFiedlPublicoOnTableCiclos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ciclos', function (Blueprint $table) {
            //
            $table->boolean('publico')->default(true)->after('activo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ciclos', function (Blueprint $table) {
            //
            $table->dropColumn('publico');
        });
    }
}
