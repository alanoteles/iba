<?php

use Illuminate\Database\Seeder;

class NewsEditorialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news_editorials')->insert([
            'status' => 1
        ]);

        DB::table('news_editorials')->insert([
            'status' => 1
        ]);

        DB::table('news_editorials')->insert([
            'status' => 1
        ]);
    }
}
