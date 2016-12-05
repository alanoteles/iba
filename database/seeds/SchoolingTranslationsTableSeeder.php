<?php

use Illuminate\Database\Seeder;
use Iba\Models\SchoolingTranslation;

class SchoolingTranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SchoolingTranslation::create([
            'name' => 'Ensino Médio',
            'locale' => 'pt_br',
            'schooling_id' => 1,
            'created_by' => 1
        ]);

        SchoolingTranslation::create([
            'name' => 'Técnico',
            'locale' => 'pt_br',
            'schooling_id' => 2,
            'created_by' => 1
        ]);

        SchoolingTranslation::create([
            'name' => 'Graduação',
            'locale' => 'pt_br',
            'schooling_id' => 3,
            'created_by' => 1
        ]);

        SchoolingTranslation::create([
            'name' => 'Pós-Graduação',
            'locale' => 'pt_br',
            'schooling_id' => 4,
            'created_by' => 1
        ]);

        SchoolingTranslation::create([
            'name' => 'MBA',
            'locale' => 'pt_br',
            'schooling_id' => 5,
            'created_by' => 1
        ]);

        SchoolingTranslation::create([
            'name' => 'Mestrado',
            'locale' => 'pt_br',
            'schooling_id' => 6,
            'created_by' => 1
        ]);

        SchoolingTranslation::create([
            'name' => 'Doutorado',
            'locale' => 'pt_br',
            'schooling_id' => 7,
            'created_by' => 1
        ]);

        SchoolingTranslation::create([
            'name' => 'Livre docência',
            'locale' => 'pt_br',
            'schooling_id' => 8,
            'created_by' => 1
        ]);

        SchoolingTranslation::create([
            'name' => 'Pós-doutorado',
            'locale' => 'pt_br',
            'schooling_id' => 9,
            'created_by' => 1
        ]);
    }
}
