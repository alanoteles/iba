<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjectObjectivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('object_objectives', function (Blueprint $table) {
            $table->increments('id');

            $table->text('subject');
            $table->integer('liked');


            $table->integer('object_id')->unsigned();
            $table->foreign('object_id')->references('id')->on('object');

            $table->integer('objective_verb_id')->unsigned();
            $table->foreign('objective_verb_id')->references('id')->on('objective_verbs');

            $table->integer('objective_content_id')->unsigned();
            $table->foreign('objective_content_id')->references('id')->on('objective_contents');

            $table->integer('objective_preposition_id')->unsigned();
            $table->foreign('objective_preposition_id')->references('id')->on('objective_prepositions');

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
        Schema::drop('object_objectives');
    }
}
