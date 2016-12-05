<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectSituationTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_situation_translations', function (Blueprint $table) {
            $table->increments('id');

            $table->text('name');

            $table->text('locale');

            $table->integer('project_situation_id')->unsigned();
            $table->foreign('project_situation_id')->references('id')->on('project_situations')->onDelete('cascade');

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
        Schema::drop('project_situation_translations');
    }
}
