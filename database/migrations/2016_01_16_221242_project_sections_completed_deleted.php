<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProjectSectionsCompletedDeleted extends Migration
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
                $table->boolean('completed')->default(false)->after('sort_order');
                $table->boolean('deleted')->default(false)->after('completed');
                $table->boolean('version')->default(1)->after('deleted');
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
