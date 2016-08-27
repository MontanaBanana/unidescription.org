<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVersions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('project_section_versions', function (Blueprint $table) {
	       $table->increments('id');
           $table->string('project_section_id');
	       $table->integer('project_id');
	       $table->string('title');
	       $table->text('description')->nullable();
	       $table->text('phonetic_description')->nullable();
	       $table->string('notes');
	       $table->string('audio_file_url')->nullable();
	       $table->boolean('audio_file_needs_update')->default(true);
	       $table->integer('sort_order')->nullable()->unsigned();
	       $table->boolean('completed')->default(false);
	       $table->boolean('deleted')->default(false);
	       $table->boolean('version')->default(1);
	       $table->timestamps(); 
	       $table->string('image_url');
	       $table->string('original_image');
	       $table->tinyInteger('has_image_rights')->default(0);
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
