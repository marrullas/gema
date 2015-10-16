<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRevisionFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('files', function(Blueprint $table)
        {

            $table->boolean('revisado')->after('ambitosxciclo_id')->default(false);
            $table->integer('auditor')->unsigned()->after('revisado')->nullable();
            $table->foreign('auditor')
                ->references('id')
                ->on('users')
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
        Schema::table('eventos', function(Blueprint $table)
        {
            //
            $table->dropColumn('revisado');
            $table->dropColumn('auditor');
        });
    }
}
