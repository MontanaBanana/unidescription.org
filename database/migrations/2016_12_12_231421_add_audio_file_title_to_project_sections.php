<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAudioFileTitleToProjectSections extends Migration
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
            $table->string('audio_file_title', 255)->after('notes');
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
            $table->dropColumn(['audio_file_title']);
        });
    }
}
