<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {



            $table->increments('id');

            $table->text('name');
            $table->string('code');

            $table->integer('country_id')->unsigned();


            $table->timestamps();

        });

        Schema::table('states', function(Blueprint $table){
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');

            $table->foreign('country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('states');
    }
}
