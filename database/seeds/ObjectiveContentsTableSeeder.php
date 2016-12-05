<?php

use Illuminate\Database\Seeder;

class ObjectiveContentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['nenhum',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['o conceito',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['a ideia',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['o fato',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['a data',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['o instrumento',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['a medida',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['a técnica',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['o método',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['a teoria',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['o significado',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['o processo',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['a atuação',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['a conquista',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['a estrutura',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['a etapa',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['a forma',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['a importância',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['a principal',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['a relevância',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['acerca',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['as abordagens',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['as ações',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['as características',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['as conquistas',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['as etapas',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['as formas',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['as possibilidades',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['as principais',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['cronologicamente',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['estratégias',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['o conceito',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['o conjunto',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['o principal',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['o processo',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['o resultado',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['os aspectos',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['os principais',1]);
        DB::insert('INSERT INTO objective_contents(text,created_by) VALUES (?,?)', ['resultados',1]);
    }
}
