<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameCreateByColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('project_translations', function(Blueprint $t) {
//            $t->renameColumn('created_by', 'user_id');
//        });

        //DB::statement("ALTER TABLE 'project_translations' CHANGE 'created_by' 'user_id'");
//        Schema::table('project_translations', function ($table) {
//            $table->renameColumn('created_by', 'user_id');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //DB::statement("ALTER TABLE `project_translations` CHANGE `user_id` `created_by`");

//        Schema::table('project_translations', function(Blueprint $t) {
//            $t->renameColumn('user_id', 'created_by');
//        });
    }
}
