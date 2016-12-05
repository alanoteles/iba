<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO languages(id,title,name,short,iso,created_by,status) VALUES (?,?,?,?,?,?,?)', ['1','Português','pt','pt-br','pt_BR','1','1']);
        DB::insert('INSERT INTO languages(id,title,name,short,iso,created_by,status) VALUES (?,?,?,?,?,?,?)', ['2','English','en','en','en_US','1','1']);
        DB::insert('INSERT INTO languages(id,title,name,short,iso,created_by,status) VALUES (?,?,?,?,?,?,?)', ['3','Español','es','es','es','1','1']);
    }
}
