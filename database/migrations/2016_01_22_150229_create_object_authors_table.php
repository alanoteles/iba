<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjectAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('object_authors', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('object_id')->unsigned();

            $table->integer('author_id')->unsigned();

            $table->integer('created_by')->unsigned();


            $table->timestamps();

        });

        Schema::table('object_authors', function(Blueprint $table){
            DB::statement('SET FOREIGN_KEY_CHECKS=0');

            $table->foreign('object_id')->references('id')->on('objects');
            $table->foreign('author_id')->references('id')->on('authors');
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('object_authors');
    }
}
