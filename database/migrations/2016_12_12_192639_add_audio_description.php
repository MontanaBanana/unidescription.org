<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAudioDescription extends Migration
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
            $table->string('audio_description', 255)->after('description');
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
            $table->dropColumn(['audio_description']);
        });
    }
}
