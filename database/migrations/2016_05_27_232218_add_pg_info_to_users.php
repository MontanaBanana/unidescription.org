<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPgInfoToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('users', function ($table) {
            $table->string('pg_build_code');
            $table->string('pg_build_access_token');
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('pg_build_code');
            $table->dropColumn('pg_build_access_token');
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
    }
}
