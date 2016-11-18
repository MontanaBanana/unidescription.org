<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLockToProjectSection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_sections', function (Blueprint $table) {
            $table->boolean('locked');
            $table->integer('locked_by_user_id');
            $table->dateTime('locked_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_sections', function (Blueprint $table) {
            //
        });
    }
}
