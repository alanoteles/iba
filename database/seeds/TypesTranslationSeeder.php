<?php

use Illuminate\Database\Seeder;

class TypesTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_translations')->insert([
            'type' => 'Plano de Aula',
            'locale' => 'pt_br',
            'type_id' => 1
        ]);

        DB::table('type_translations')->insert([
            'type' => 'Ementa',
            'locale' => 'pt_br',
            'type_id' => 2
        ]);

        DB::table('type_translations')->insert([
            'type' => 'Estudo de Caso',
            'locale' => 'pt_br',
            'type_id' => 3
        ]);

        DB::table('type_translations')->insert([
            'type' => 'Atividade',
            'locale' => 'pt_br',
            'type_id' => 4
        ]);

        DB::table('type_translations')->insert([
            'type' => 'Livro',
            'locale' => 'pt_br',
            'type_id' => 5
        ]);

        DB::table('type_translations')->insert([
            'type' => 'Artigo',
            'locale' => 'pt_br',
            'type_id' => 6
        ]);

        DB::table('type_translations')->insert([
            'type' => 'Avaliação',
            'locale' => 'pt_br',
            'type_id' => 7
        ]);

        DB::table('type_translations')->insert([
            'type' => 'Apostila',
            'locale' => 'pt_br',
            'type_id' => 8
        ]);

        DB::table('type_translations')->insert([
            'type' => 'Relatório',
            'locale' => 'pt_br',
            'type_id' => 9
        ]);

        DB::table('type_translations')->insert([
            'type' => 'Legislação',
            'locale' => 'pt_br',
            'type_id' => 10
        ]);

        DB::table('type_translations')->insert([
            'type' => 'Revista',
            'locale' => 'pt_br',
            'type_id' => 11
        ]);


    }
}
