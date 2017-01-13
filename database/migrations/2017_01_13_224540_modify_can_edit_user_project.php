<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyCanEditUserProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {	
        Schema::table('project_user', function ($table) {
		$table->dropColumn('can_edit');
        });
    }

    public function down()
    {
    }
}
