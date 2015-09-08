<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDescripcionNombreDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('documentos', function(Blueprint $table)
        {
            //
            $table->string('nombre')->after('id');
            $table->text('descripcion')->nullable()->after('nombre');

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
        Schema::table('documentos', function(Blueprint $table)
        {
            //
            $table->dropColumn('nombre');
            $table->dropColumn('descripcion');
        });
    }
}
