<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixCanEditUserProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */


    public function up()
    {
        Schema::table('project_user', function ($table) {
                $table->boolean('can_edit')->default(true)->after('user_id');
        });
    }

    public function down()
    {
    }
}
