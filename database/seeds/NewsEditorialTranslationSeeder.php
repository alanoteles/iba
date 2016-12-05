<?php

use Illuminate\Database\Seeder;

class NewsEditorialTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news_editorial_translations')->insert([
            'name' => 'Editorial #1',
            'locale' => 'pt_br',
            'news_editorial_id' => 1,
            'created_by' => 1
        ]);

        DB::table('news_editorial_translations')->insert([
            'name' => 'Editorial #2',
            'locale' => 'pt_br',
            'news_editorial_id' => 2,
            'created_by' => 1
        ]);

        DB::table('news_editorial_translations')->insert([
            'name' => 'Editorial #3',
            'locale' => 'pt_br',
            'news_editorial_id' => 3,
            'created_by' => 1
        ]);
    }
}
