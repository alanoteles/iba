<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjectCertificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('object_certifications', function (Blueprint $table) {
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');

            $table->increments('id');

            $table->integer('object_id')->unsigned();
            $table->foreign('object_id')->references('id')->on('objects');

            $table->integer('sealer_id')->unsigned();
            $table->foreign('sealer_id')->references('id')->on('sealers');

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
        Schema::drop('object_certifications');
    }
}
