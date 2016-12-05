<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->text('image_alt');

            $table->text('locale');

            $table->integer('social_id')->unsigned();
            $table->foreign('social_id')->references('id')->on('socials')->onDelete('cascade');

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
        Schema::drop('social_translations');
    }
}
