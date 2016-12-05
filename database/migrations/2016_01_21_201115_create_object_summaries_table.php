<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjectSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('object_summaries', function (Blueprint $table) {
            $table->increments('id');

            //@TODO Removida coluna user_id que parecia redundante

            $table->integer('object_id')->unsigned();
            $table->foreign('object_id')->references('id')->on('object');

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
        Schema::drop('object_summaries');
    }
}
