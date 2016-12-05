<?php

use Illuminate\Database\Seeder;

class AdministrativeAreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('administrative_areas')->insert([
            'id' => 1,
            'title' => 'Usuários',
            'description' => 'Gestão de usuários que acessam a administração do portal',
            'status' => 1
        ]);

        DB::table('administrative_areas')->insert([
            'id' => 2,
            'title' => 'Objetos',
            'description' => 'Gestão de objetos',
            'status' => 1
        ]);

        DB::table('administrative_areas')->insert([
            'id' => 3,
            'title' => 'Notícias',
            'description' => 'Gestão de notícias do portal',
            'status' => 1
        ]);

        DB::table('administrative_areas')->insert([
            'id' => 4,
            'title' => 'Seções',
            'description' => 'Seções fixas do portal',
            'status' => 1
        ]);

        DB::table('administrative_areas')->insert([
            'id' => 5,
            'title' => 'Parceiros',
            'description' => 'Gerenciar parceiros do cliente (ou associadas, etc)',
            'status' => 1
        ]);

        DB::table('administrative_areas')->insert([
            'id' => 6,
            'title' => 'Banners',
            'description' => 'Gerenciar os banners de destaque do portal (home, internas, etc)',
            'status' => 1
        ]);

        DB::table('administrative_areas')->insert([
            'id' => 7,
            'title' => 'Tabelas de Apoio',
            'description' => 'Tabelas para gerencias tipos e informações que apoiam os demais módulos',
            'status' => 1
        ]);

    }
}
