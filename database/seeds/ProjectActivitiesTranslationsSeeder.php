<?php

use Illuminate\Database\Seeder;
use Iba\Models\ProjectActivityTranslation;

class ProjectActivitiesTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectActivityTranslation::create([
            'name' => 'Atividade #1',
            'locale' => 'pt_br',
            'project_activity_id' => 1
        ]);

        ProjectActivityTranslation::create([
            'name' => 'Atividade #2',
            'locale' => 'pt_br',
            'project_activity_id' => 2
        ]);

        ProjectActivityTranslation::create([
            'name' => 'Atividade #3',
            'locale' => 'pt_br',
            'project_activity_id' => 3
        ]);
    }
}
