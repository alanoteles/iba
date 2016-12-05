<?php

use Illuminate\Database\Seeder;
use Iba\Models\ProjectTypeTranslation;

class ProjectTypeTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectTypeTranslation::create([
            'name' => 'Tipo #1',
            'locale' => 'pt_br',
            'project_type_id' => 1
        ]);

        ProjectTypeTranslation::create([
            'name' => 'Tipo #2',
            'locale' => 'pt_br',
            'project_type_id' => 2
        ]);

        ProjectTypeTranslation::create([
            'name' => 'Tipo #3',
            'locale' => 'pt_br',
            'project_type_id' => 3
        ]);
    }
}
