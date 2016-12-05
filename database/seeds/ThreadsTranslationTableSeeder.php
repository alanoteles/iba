<?php

use Illuminate\Database\Seeder;
use Iba\Models\ThreadTranslation;

class ThreadsTranslationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ThreadTranslation::create([
            'title' => 'Linha 1',
            'locale' => 'pt_br',
            'created_by' => 1,
            'thread_id' => 1
        ]);

        ThreadTranslation::create([
            'title' => 'Linha 2',
            'locale' => 'pt_br',
            'created_by' => 1,
            'thread_id' => 2
        ]);

        ThreadTranslation::create([
            'title' => 'Linha 3',
            'locale' => 'pt_br',
            'created_by' => 1,
            'thread_id' => 3
        ]);

        ThreadTranslation::create([
            'title' => 'Linha 4',
            'locale' => 'pt_br',
            'created_by' => 1,
            'thread_id' => 4

        ]);

        ThreadTranslation::create([
            'title' => 'Linha 5',
            'locale' => 'pt_br',
            'created_by' => 1,
            'thread_id' => 5
        ]);
    }
}
