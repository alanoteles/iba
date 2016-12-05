<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjectDiscussionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('object_discussions', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('object_id')->unsigned();
            $table->foreign('object_id')->references('id')->on('objects');

            $table->integer('parent_id')->nullabe();
            $table->text('text');
            $table->integer('liked');

            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users');

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
        Schema::drop('object_discussions');
    }
}
