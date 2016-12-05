<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjectObjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('object_objects', function (Blueprint $table) {
            $table->increments('id');

            $table->text('table');

            $table->integer('relationship_id')->unsigned();

            $table->integer('object_id')->unsigned();
            $table->foreign('object_id')->references('id')->on('objects');

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
        Schema::drop('object_objects');
    }
}
