<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSealersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sealers', function (Blueprint $table) {
            $table->increments('id');


            $table->text('url');
            $table->text('image_path');
            $table->text('image_filename');
            $table->text('image_type');

            $table->boolean('status')->default(1);

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
        Schema::drop('sealers');
    }
}
