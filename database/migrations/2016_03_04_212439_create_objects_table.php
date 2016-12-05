<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objects', function (Blueprint $table) {
            $table->increments('id');
            $table->text('issn');
            $table->integer('starred');
            $table->integer('faved');
            $table->integer('shared');
            $table->integer('access_count');
            $table->integer('active');
            $table->integer('allow_seals');
            $table->integer('allow_collab');
            $table->integer('public');

            $table->integer('license_id')->unsigned()->default(null);
            $table->foreign('license_id')->references('id')->on('licenses');

            $table->integer('type_id')->unsigned()->default(null);
            $table->foreign('type_id')->references('id')->on('types');

            $table->integer('filetype_id')->unsigned()->default(null);
            $table->foreign('filetype_id')->references('id')->on('filetypes');

            $table->integer('thread_id')->unsigned()->default(null);
            $table->foreign('thread_id')->references('id')->on('threads');

            $table->integer('topic_id')->unsigned()->default(null);
            $table->foreign('topic_id')->references('id')->on('topics');

            $table->integer('subtopic_id')->unsigned()->default(null);
            $table->foreign('subtopic_id')->references('id')->on('subtopics');

            $table->integer('banner_id')->unsigned()->default(null);
            $table->foreign('banner_id')->references('id')->on('banners');

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
        Schema::drop('objects');
    }
}
