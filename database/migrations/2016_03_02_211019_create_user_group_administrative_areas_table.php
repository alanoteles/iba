<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserGroupAdministrativeAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_group_administrative_areas', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('administrative_area_id')->unsigned();
            $table->foreign('administrative_area_id')->references('id')->on('administrative_areas')->onDelete('cascade');

            $table->integer('user_group_id')->unsigned();
            $table->foreign('user_group_id')->references('id')->on('user_groups')->onDelete('cascade');

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
        Schema::drop('user_group_administrative_areas');
    }
}
