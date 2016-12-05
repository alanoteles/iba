<?php

use Illuminate\Database\Seeder;
use Iba\Models\ProjectTranslation;

class ProjectTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectTranslation::create([
            'id' => 1,
            'title' => 'Projeto de Teste #1',
            'summary' => 'Lorem Ipsum dolor sit amet lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet',
            'comment' => 'Donec eget porta odio. Suspendisse a ligula at tortor congue commodo ut in lacus. In nibh urna, rutrum ac luctus vestibulum, sagittis vitae justo.',
            'results' => 'Fusce blandit rhoncus magna suscipit fringilla. Vestibulum vitae velit justo. Maecenas vitae tristique nunc. Cras hendrerit non magna scelerisque commodo.',
            'locale' => 'pt_br',
            'project_id' => 1,
            'created_by' => 1
        ]);



        ProjectTranslation::create([
            'id' => 2,
            'title' => 'Projeto de Teste #2',
            'summary' => 'Lorem Ipsum dolor sit amet lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet',
            'comment' => 'Donec eget porta odio. Suspendisse a ligula at tortor congue commodo ut in lacus. In nibh urna, rutrum ac luctus vestibulum, sagittis vitae justo.',
            'results' => 'Fusce blandit rhoncus magna suscipit fringilla. Vestibulum vitae velit justo. Maecenas vitae tristique nunc. Cras hendrerit non magna scelerisque commodo.',
            'locale' => 'pt_br',
            'project_id' => 2,
            'created_by' => 1
        ]);


        ProjectTranslation::create([
            'id' => 3,
            'title' => 'Projeto de Teste #3',
            'summary' => 'Lorem Ipsum dolor sit amet lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet',
            'comment' => 'Donec eget porta odio. Suspendisse a ligula at tortor congue commodo ut in lacus. In nibh urna, rutrum ac luctus vestibulum, sagittis vitae justo.',
            'results' => 'Fusce blandit rhoncus magna suscipit fringilla. Vestibulum vitae velit justo. Maecenas vitae tristique nunc. Cras hendrerit non magna scelerisque commodo.',
            'locale' => 'pt_br',
            'project_id' => 3,
            'created_by' => 1
        ]);
    }
}
