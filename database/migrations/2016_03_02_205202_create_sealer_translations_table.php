<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSealerTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sealer_translations', function (Blueprint $table) {
            $table->increments('id');

            $table->text('name');
            $table->text('image_alternative_text');

            $table->text('locale');

            $table->integer('sealer_id')->unsigned();
            $table->foreign('sealer_id')->references('id')->on('sealers')->onDelete('cascade');

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
        Schema::drop('sealer_translations');
    }
}
