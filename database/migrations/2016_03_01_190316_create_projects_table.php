<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');

            $table->text('number');
            $table->date('meeting_date');
            $table->date('implementation_period_start');
            $table->date('implementation_period_end');

            $table->text('project_value');

            $table->boolean('status');

            $table->integer('project_type_id')->unsigned();
            $table->foreign('project_type_id')->references('id')->on('project_types')->onDelete('cascade');

            $table->integer('project_situation_id')->unsigned();
            $table->foreign('project_situation_id')->references('id')->on('project_situations')->onDelete('cascade');

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
        Schema::drop('projects');
    }
}
