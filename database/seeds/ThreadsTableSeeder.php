<?php

use Illuminate\Database\Seeder;
use Iba\Models\Thread;


class ThreadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Thread::create([
           'id' => 1

        ]);

       Thread::create([
           'id' => 2
        ]);

       Thread::create([
           'id' => 3
        ]);

       Thread::create([
           'id' => 4
        ]);

       Thread::create([
           'id' => 5
        ]);
    }
}
