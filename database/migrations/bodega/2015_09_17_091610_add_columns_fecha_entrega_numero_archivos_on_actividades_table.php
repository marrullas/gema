<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsFechaEntregaNumeroArchivosOnActividadesTable extends Migration
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

            $table->date('entrega')->nullable()->after('actividad_siguiente');
            $table->integer('numeroarchivos')->nullable()->default(4)->after('entrega'); //numero maximo de archivos de evidencia
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
            $table->dropColumn('entrega');
            $table->dropColumn('numeroarchivos');
        });
    }
}
