<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnEstadoncsIdOnTableSeguimientosncs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seguimientoncs', function (Blueprint $table) {
            //
            $table->boolean('estadoncs_id')->unsigned()->default(1)->after('detalle');

        });
        // no se permitio crear llave foranea porque ya habian datos
/*        Schema::table('seguimientoncs', function (Blueprint $table) {
            //
            $table->foreign('estadoncs_id')
                ->references('id')
                ->on('estadoncs')
                ->onDelete('cascade');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seguimientoncs', function (Blueprint $table) {
            //
            $table->dropColumn('estadoncs_id');
        });
    }
}
