<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProjectTodos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_todos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('assigned_user_id')->unsigned();
            $table->integer('project_section_id')->unsigned()->default(0);
            $table->string('title');
            $table->text('description');
            $table->integer('sort_order');
            $table->boolean('completed')->default(false);
            $table->boolean('deleted')->default(false);
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
        Schema::drop('project_todos');
    }
}
