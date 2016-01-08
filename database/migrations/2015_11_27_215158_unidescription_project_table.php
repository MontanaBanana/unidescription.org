<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UnidescriptionProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {		
		Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('title');
            $table->text('description');
            $table->timestamps();
        });
        
        Schema::create('project_users', function (Blueprint $table) {
	       $table->increments('id');
	       $table->integer('project_id')->unsigned();
	       $table->integer('user_id')->unsigned();
	       $table->timestamps();
        });
        
        Schema::create('project_sections', function (Blueprint $table) {
	       $table->increments('id');
	       $table->integer('project_id');
	       $table->integer('section_template_id')->nullable()->unsigned();
	       $table->string('title');
	       $table->text('description')->nullable();
	       $table->string('audio_file_url')->nullable();
	       $table->integer('sort_order')->nullable()->unsigned();
	       $table->timestamps(); 
        });
        
        Schema::create('section_templates', function (Blueprint $table) {
	       $table->increments('id');
	       $table->integer('section_template_id')->unsigned()->nullable();
	       $table->string('title');
	       $table->text('description');
	       $table->integer('sort_order')->unsigned();
	       $table->timestamps(); 
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
