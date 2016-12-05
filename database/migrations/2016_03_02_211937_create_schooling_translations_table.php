<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolingTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schooling_translations', function (Blueprint $table) {
            $table->increments('id');

            $table->text('name');
            $table->text('locale');

            $table->integer('schooling_id')->unsigned();
            $table->foreign('schooling_id')->references('id')->on('schoolings')->onDelete('cascade');

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
        Schema::drop('schooling_translations');
    }
}
