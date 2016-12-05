<?php

use Illuminate\Database\Seeder;


class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('topics')->insert([
            'thread_id' => 1
        ]);

        DB::table('topics')->insert([
            'thread_id' => 1
        ]);

        DB::table('topics')->insert([
            'thread_id' => 1
        ]);

        DB::table('topics')->insert([
            'thread_id' => 2
        ]);

        DB::table('topics')->insert([
            'thread_id' => 2
        ]);

        DB::table('topics')->insert([
            'thread_id' => 2
        ]);

        DB::table('topics')->insert([
            'thread_id' => 3
        ]);

        DB::table('topics')->insert([
            'thread_id' => 3
        ]);

        DB::table('topics')->insert([
            'thread_id' => 3
        ]);

        DB::table('topics')->insert([
            'thread_id' => 4
        ]);

        DB::table('topics')->insert([
            'thread_id' => 4
        ]);

        DB::table('topics')->insert([
            'thread_id' => 4
        ]);

        DB::table('topics')->insert([
            'thread_id' => 4
        ]);

        DB::table('topics')->insert([
            'thread_id' => 5
        ]);

        DB::table('topics')->insert([
            'thread_id' => 5
        ]);

        DB::table('topics')->insert([
            'thread_id' => 5
        ]);


        //-- Cria os subtemas

        DB::table('topics')->insert([
            'topic_id' => 1
        ]);

        DB::table('topics')->insert([
            'topic_id' => 1
        ]);

        DB::table('topics')->insert([
            'topic_id' => 1
        ]);

        DB::table('topics')->insert([
            'topic_id' => 2
        ]);

        DB::table('topics')->insert([
            'topic_id' => 2
        ]);

        DB::table('topics')->insert([
            'topic_id' => 2
        ]);

        DB::table('topics')->insert([
            'topic_id' => 3
        ]);

        DB::table('topics')->insert([
            'topic_id' => 3
        ]);

        DB::table('topics')->insert([
            'topic_id' => 3
        ]);

        DB::table('topics')->insert([
            'topic_id' => 4
        ]);

        DB::table('topics')->insert([
            'topic_id' => 4
        ]);

        DB::table('topics')->insert([
            'topic_id' => 4
        ]);

        DB::table('topics')->insert([
            'topic_id' => 4
        ]);

        DB::table('topics')->insert([
            'topic_id' => 5
        ]);

        DB::table('topics')->insert([
            'topic_id' => 5
        ]);

        DB::table('topics')->insert([
            'topic_id' => 5
        ]);


    }
}
