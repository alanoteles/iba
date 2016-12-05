<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsEditorialTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_editorial_translations', function (Blueprint $table) {
            $table->increments('id');

            $table->text('name');

            $table->text('locale');

            $table->integer('news_editorial_id')->unsigned();
            $table->foreign('news_editorial_id')->references('id')->on('news_editorials')->onDelete('cascade');

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
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::drop('news_editorial_translations');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
