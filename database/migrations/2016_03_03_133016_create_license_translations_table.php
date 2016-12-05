<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicenseTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('license_translations', function (Blueprint $table) {
            $table->increments('id');

            $table->text('name');
            $table->text('summary');

            $table->text('locale');

            $table->integer('license_id')->unsigned();
            $table->foreign('license_id')->references('id')->on('licenses')->onDelete('cascade');

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
        Schema::drop('license_translations');
    }
}
