<?php

use Illuminate\Database\Seeder;

class LevelsTranslationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO level_translations(id,name, locale, created_by) VALUES (?,?,?,?)', ['1','Fundamental','pt_br','1']);
        DB::insert('INSERT INTO level_translations(id,name, locale, created_by) VALUES (?,?,?,?)', ['2','Básico','pt_br','1']);
        DB::insert('INSERT INTO level_translations(id,name, locale, created_by) VALUES (?,?,?,?)', ['3','Médio','pt_br','1']);
        DB::insert('INSERT INTO level_translations(id,name, locale, created_by) VALUES (?,?,?,?)', ['4','Graduação','pt_br','1']);
        DB::insert('INSERT INTO level_translations(id,name, locale, created_by) VALUES (?,?,?,?)', ['5','Pós-graduação','pt_br','1']);
    }
}
