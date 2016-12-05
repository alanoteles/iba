<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schoolings', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('order');

            $table->integer('created_by')->unsigned();


            $table->timestamps();

        });

        Schema::table('schoolings', function(Blueprint $table){
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');

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
        Schema::drop('schoolings');
    }
}
