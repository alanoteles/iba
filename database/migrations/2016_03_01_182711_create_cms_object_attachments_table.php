<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsObjectAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_object_attachments', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('fk_id')->unsigned();
            $table->text('module');

            $table->integer('object_id')->unsigned();
            $table->foreign('object_id')->references('id')->on('object')->onDelete('cascade');

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
        Schema::drop('cms_object_attachments');
    }
}
