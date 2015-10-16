<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddColumnEstadoAlterTipoOnTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->boolean('active')->default(true)->after('full_name');

        });
        DB::statement("ALTER TABLE users CHANGE COLUMN type type ENUM('admin', 'user','instructor' ,'ie', 'lider','auditor', 'coordinador', 'pedagogo')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('active');
        });
    }
}
