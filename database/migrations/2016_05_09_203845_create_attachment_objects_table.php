<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentObjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachment_object', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('object_id')->unsigned()->default(null);
            $table->foreign('object_id')->references('id')->on('objects');

            $table->integer('attachment_id')->unsigned()->default(null);
            $table->foreign('attachment_id')->references('id')->on('attachments');


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
        Schema::drop('attachment_objects');
    }
}
