<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAudioTitle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('project_sections', function ($table) {
            $table->string('audio_title', 255)->after('title');
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
        Schema::table('project_sections', function ($table) {
            $table->dropColumn(['audio_title']);
        });
    }
}
