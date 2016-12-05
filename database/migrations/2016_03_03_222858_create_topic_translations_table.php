<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topic_translations', function (Blueprint $table) {
            $table->increments('id');

            $table->text('title');

            $table->text('locale');

            $table->integer('topic_id')->unsigned();
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');

            $table->integer('subtopic_id')->unsigned()->default(null);
            $table->foreign('subtopic_id')->references('id')->on('topics');

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
        Schema::drop('topic_translations');
    }
}
