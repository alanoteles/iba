<?php

use Illuminate\Database\Seeder;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO levels(id) VALUES (?)', ['1']);
        DB::insert('INSERT INTO levels(id) VALUES (?)', ['2']);
        DB::insert('INSERT INTO levels(id) VALUES (?)', ['3']);
        DB::insert('INSERT INTO levels(id) VALUES (?)', ['4']);
        DB::insert('INSERT INTO levels(id) VALUES (?)', ['5']);
    }
}
