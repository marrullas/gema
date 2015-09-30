<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAmbitosxcicloIdFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('files', function (Blueprint $table) {
            //
            $table->integer('ambitosxciclo_id')->unsigned()->nullable()->after('tipodocumento_id');
            $table->foreign('ambitosxciclo_id')
                ->references('id')
                ->on('ambitosxciclo')
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
        Schema::table('files', function (Blueprint $table) {
            //
            $table->dropColumn('ambitosxciclo_id');
        });
    }
}
