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
        });
    }
}
