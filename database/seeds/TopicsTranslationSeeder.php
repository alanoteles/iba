<?php

use Illuminate\Database\Seeder;

class TopicsTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('topic_translations')->insert([
            'title' => 'Tema 1',
            'locale'    => 'pt_br',
            'topic_id' => 1,
            'created_by' => 1
        ]);

        DB::table('topic_translations')->insert([
            'title' => 'Tema 2',
            'locale'    => 'pt_br',
            'topic_id' => 1,
            'created_by' => 1
        ]);

        DB::table('topic_translations')->insert([
            'title' => 'Tema 3',
            'locale'    => 'pt_br',
            'topic_id' => 1,
            'created_by' => 1
        ]);

        DB::table('topic_translations')->insert([
            'title' => 'Tema 1',
            'locale'    => 'pt_br',
            'topic_id' => 2,
            'created_by' => 1
        ]);

        DB::table('topic_translations')->insert([
            'title' => 'Tema 2',
            'locale'    => 'pt_br',
            'topic_id' => 2,
            'created_by' => 1
        ]);

        DB::table('topic_translations')->insert([
            'title' => 'Tema 3',
            'locale'    => 'pt_br',
            'topic_id' => 2,
            'created_by' => 1
        ]);

        DB::table('topic_translations')->insert([
            'title' => 'Tema 1',
            'locale'    => 'pt_br',
            'topic_id' => 3,
            'created_by' => 1
        ]);

        DB::table('topic_translations')->insert([
            'title' => 'Tema 2',
            'locale'    => 'pt_br',
            'topic_id' => 3,
            'created_by' => 1
        ]);

        DB::table('topic_translations')->insert([
            'title' => 'Tema 3',
            'locale'    => 'pt_br',
            'topic_id' => 3,
            'created_by' => 1
        ]);

        DB::table('topic_translations')->insert([
            'title' => 'Tema 1',
            'locale'    => 'pt_br',
            'topic_id' => 4,
            'created_by' => 1
        ]);

        DB::table('topic_translations')->insert([
            'title' => 'Tema 2',
            'locale'    => 'pt_br',
            'topic_id' => 4,
            'created_by' => 1
        ]);

        DB::table('topic_translations')->insert([
            'title' => 'Tema 2',
            'locale'    => 'pt_br',
            'topic_id' => 4,
            'created_by' => 1
        ]);

        DB::table('topic_translations')->insert([
            'title' => 'Tema 3',
            'locale'    => 'pt_br',
            'topic_id' => 4,
            'created_by' => 1
        ]);

        DB::table('topic_translations')->insert([
            'title' => 'Tema 1',
            'locale'    => 'pt_br',
            'topic_id' => 5,
            'created_by' => 1
        ]);

        DB::table('topic_translations')->insert([
            'title' => 'Tema 2',
            'locale'    => 'pt_br',
            'topic_id' => 5,
            'created_by' => 1
        ]);

        DB::table('topic_translations')->insert([
            'title' => 'Tema 3',
            'locale'    => 'pt_br',
            'topic_id' => 5,
            'created_by' => 1
        ]);


        //-- Inclui os subtemas

        DB::table('topic_translations')->insert([
            'title' => 'Subtema 1',
            'locale'    => 'pt_br',
            'subtopic_id' => 1,
            'created_by' => 1
        ]);

        DB::table('topic_translations')->insert([
            'title' => 'Subtema 2',
            'locale'    => 'pt_br',
            'subtopic_id' => 1,
            'created_by' => 1
        ]);

        DB::table('topic_translations')->insert([
            'title' => 'Subtema 3',
            'locale'    => 'pt_br',
            'subtopic_id' => 1,
            'created_by' => 1
        ]);

        DB::table('topic_translations')->insert([
            'title' => 'Subtema 1',
            'locale'    => 'pt_br',
            'subtopic_id' => 2,
            'created_by' => 1
        ]);

        DB::table('topic_translations')->insert([
            'title' => 'Subtema 2',
            'locale'    => 'pt_br',
            'subtopic_id' => 2,
            'created_by' => 1
        ]);

        DB::table('topic_translations')->insert([
            'title' => 'Subtema 3',
            'locale'    => 'pt_br',
            'subtopic_id' => 2,
            'created_by' => 1
        ]);

        DB::table('topic_translations')->insert([
            'title' => 'Subtema 1',
            'locale'    => 'pt_br',
            'subtopic_id' => 3,
            'created_by' => 1
        ]);

        DB::table('topic_translations')->insert([
            'title' => 'Subtema 2',
            'locale'    => 'pt_br',
            'subtopic_id' => 3,
            'created_by' => 1
        ]);

        DB::table('topic_translations')->insert([
            'title' => 'Subtema 3',
            'locale'    => 'pt_br',
            'subtopic_id' => 3,
            'created_by' => 1
        ]);

        DB::table('topic_translations')->insert([
            'title' => 'Subtema 1',
            'locale'    => 'pt_br',
            'subtopic_id' => 4,
            'created_by' => 1
        ]);

        DB::table('topic_translations')->insert([
            'title' => 'Subtema 2',
            'locale'    => 'pt_br',
            'subtopic_id' => 4,
            'created_by' => 1
        ]);

        DB::table('topic_translations')->insert([
            'title' => 'Subtema 2',
            'locale'    => 'pt_br',
            'subtopic_id' => 4,
            'created_by' => 1
        ]);

        DB::table('topic_translations')->insert([
            'title' => 'Subtema 3',
            'locale'    => 'pt_br',
            'subtopic_id' => 4,
            'created_by' => 1
        ]);

        DB::table('topic_translations')->insert([
            'title' => 'Subtema 1',
            'locale'    => 'pt_br',
            'subtopic_id' => 5,
            'created_by' => 1
        ]);

        DB::table('topic_translations')->insert([
            'title' => 'Subtema 2',
            'locale'    => 'pt_br',
            'subtopic_id' => 5,
            'created_by' => 1
        ]);

        DB::table('topic_translations')->insert([
            'title' => 'Subtema 3',
            'locale'    => 'pt_br',
            'subtopic_id' => 5,
            'created_by' => 1
        ]);
    }
}
