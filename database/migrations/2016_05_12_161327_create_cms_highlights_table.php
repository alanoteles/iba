<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmsHighlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_highlights', function (Blueprint $table) {
            $table->increments('id');

            $table->string('module');
            $table->string('position');
            $table->string('page');

            $table->integer('record_id')->unsigned()->default(null);

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
        Schema::drop('cms_highlights');
    }
}
