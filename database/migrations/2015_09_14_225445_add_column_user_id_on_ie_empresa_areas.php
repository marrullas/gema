<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnUserIdOnIeEmpresaAreas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
/*        Schema::table('ies', function (Blueprint $table) {
            //
            $table->integer('user_id')->unsigned()->nullable()->after('detalles');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
        Schema::table('empresas', function (Blueprint $table) {
            //
            $table->integer('user_id')->unsigned()->nullable()->after('fechacorte');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
        Schema::table('areasprogramas', function (Blueprint $table) {
            //
            $table->integer('user_id')->unsigned()->nullable()->after('empresa_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
/*        Schema::table('ies', function (Blueprint $table) {
            //
            $table->dropColumn('user_id');
        });
        Schema::table('empresas', function (Blueprint $table) {
            //
            $table->dropColumn('user_id');
        });
        Schema::table('areasprogramas', function (Blueprint $table) {
            //
            $table->dropColumn('user_id');
        });*/
    }
}
