<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCanEditToUserProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('project_user', function ($table) {
	        $table->boolean('can_edit')->default(false)->after('user_id');
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
        Schema::table('project_user', function ($table) {
            $table->dropColumn(['can_edit']);
        });
    }

}
