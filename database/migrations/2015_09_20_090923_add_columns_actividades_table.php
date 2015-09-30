<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsActividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('actividades', function (Blueprint $table) {
            //
            $table->boolean('evidencia')->default(true)->after('actividad_siguiente'); //requiere evidencia
            $table->boolean('digital')->default(true)->after('evidencia'); //requiere evidencia digital
            $table->boolean('fisica')->default(false)->after('digital'); //requiere evidencia fisica
            $table->boolean('periodico')->default(false)->after('fisica'); //se repite en el tiempo (no usado aun)
            $table->integer('documento_id')->unsigned()->nullable()->after('periodico'); //documento default(tabla) que se espera como evidencia
            $table->foreign('documento_id')
                ->references('id')
                ->on('documentos')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('actividades', function (Blueprint $table) {
            //
            $table->dropColumn('evidencia');
            $table->dropColumn('digital');
            $table->dropColumn('fisica');
            $table->dropColumn('periodico');
            $table->dropForeign('documento_id');
            $table->dropColumn('documento_id');
        });
    }
}
