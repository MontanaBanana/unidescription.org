<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SectionTemplatesCompletedDeleted extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('section_templates', function ($table) {
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
