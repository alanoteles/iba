<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectActivityTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_activity_translations', function (Blueprint $table) {
            $table->increments('id');

            $table->text('name');

            $table->text('locale');

            $table->integer('project_activity_id')->unsigned();
            $table->foreign('project_activity_id')->references('id')->on('project_activities')->onDelete('cascade');

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
        Schema::drop('project_activity_translations');
    }
}
