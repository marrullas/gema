<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnCaracterizarncsTableNcs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ncs', function (Blueprint $table) {
            //
            $table->integer('caracterizarncs_id')->after('estadoncs_id')->default(100);

/*            $table->foreign('caracterizancs_id')
                ->references('id')
                ->on('caracterizarncs')
                ->onDelete('cascade');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ncs', function (Blueprint $table) {
            //
            $table->dropColumn('caracterizarncs_id');
        });
    }
}
