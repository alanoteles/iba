<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFiletypeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filetype_translations', function (Blueprint $table) {
            $table->increments('id');

            $table->text('type');
            $table->text('alt_image');
            $table->text('alt_cover');

            $table->text('locale');

            $table->integer('filetype_id')->unsigned();
            $table->foreign('filetype_id')->references('id')->on('filetypes')->onDelete('cascade');

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
        Schema::drop('filetype_translations');
    }
}
