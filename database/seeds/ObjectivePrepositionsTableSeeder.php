<?php

use Illuminate\Database\Seeder;

class ObjectivePrepositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO objective_prepositions(text,created_by) VALUES (?,?)', ['nenhum', 1]);
        DB::insert('INSERT INTO objective_prepositions(text,created_by) VALUES (?,?)', ['de', 1]);
        DB::insert('INSERT INTO objective_prepositions(text,created_by) VALUES (?,?)', ['do', 1]);
        DB::insert('INSERT INTO objective_prepositions(text,created_by) VALUES (?,?)', ['da', 1]);
        DB::insert('INSERT INTO objective_prepositions(text,created_by) VALUES (?,?)', ['dos', 1]);
        DB::insert('INSERT INTO objective_prepositions(text,created_by) VALUES (?,?)', ['das', 1]);
        DB::insert('INSERT INTO objective_prepositions(text,created_by) VALUES (?,?)', ['para', 1]);
        DB::insert('INSERT INTO objective_prepositions(text,created_by) VALUES (?,?)', ['sobre', 1]);

    }
}
