<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjectAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('object_attachments', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('object_id')->unsigned();

            $table->integer('attachment_id')->unsigned();

            $table->integer('created_by')->unsigned();


            $table->timestamps();
        });

        Schema::table('object_attachments', function(Blueprint $table){
            DB::statement('SET FOREIGN_KEY_CHECKS=0');

            $table->foreign('object_id')->references('id')->on('objects');
            $table->foreign('attachment_id')->references('id')->on('attachments');
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('object_attachments');
    }
}
