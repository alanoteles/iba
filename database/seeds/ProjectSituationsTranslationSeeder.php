<?php

use Illuminate\Database\Seeder;
use Iba\Models\ProjectSituationTranslation;

class ProjectSituationsTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectSituationTranslation::create([
            'name' => 'Situação #1',
            'locale' => 'pt_br',
            'project_situation_id' => 1
        ]);

        ProjectSituationTranslation::create([
            'name' => 'Situação #2',
            'locale' => 'pt_br',
            'project_situation_id' => 2
        ]);

        ProjectSituationTranslation::create([
            'name' => 'Situação #3',
            'locale' => 'pt_br',
            'project_situation_id' => 3
        ]);
    }
}
