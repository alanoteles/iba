<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_groups', function (Blueprint $table) {
            $table->increments('id');

            $table->text('name');
            $table->text('description');
            $table->boolean('view_object');
            $table->boolean('create_object');
            $table->boolean('seal_object');
            $table->boolean('status');

            $table->integer('user_profile_id')->unsigned();
            $table->foreign('user_profile_id')->references('id')->on('user_profiles')->onDelete('cascade');

            $table->integer('sealer_id')->unsigned();
            $table->foreign('sealer_id')->references('id')->on('sealers')->onDelete('cascade');

            $table->integer('state_id')->unsigned();
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');



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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('user_groups');
    }
}
