<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjectiveVerbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objective_verbs', function (Blueprint $table) {
            $table->increments('id');

            $table->text('text');

            $table->integer('verb_id')->unsigned()->nullable();
            $table->foreign('verb_id')->references('id')->on('objective_verbs');
            $table->integer('verb_type')->unsigned();

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
        Schema::drop('objective_verbs');
    }
}
