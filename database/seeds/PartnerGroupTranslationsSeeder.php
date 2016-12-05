<?php

use Illuminate\Database\Seeder;

class PartnerGroupTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Iba\Models\PartnerGroupTranslation::create([
            'id' => 1,
            'name' => 'Grupo #1',
            'locale' => 'pt_br',
            'partner_group_id' => 1
        ]);

        \Iba\Models\PartnerGroupTranslation::create([
            'id' => 2,
            'name' => 'Grupo #2',
            'locale' => 'pt_br',
            'partner_group_id' => 2
        ]);

        \Iba\Models\PartnerGroupTranslation::create([
            'id' => 3,
            'name' => 'Grupo #3',
            'locale' => 'pt_br',
            'partner_group_id' => 3
        ]);


        \Iba\Models\PartnerGroupTranslation::create([
            'id' => 4,
            'name' => 'Group #1',
            'locale' => 'en',
            'partner_group_id' => 1
        ]);

        \Iba\Models\PartnerGroupTranslation::create([
            'id' => 5,
            'name' => 'Group #2',
            'locale' => 'en',
            'partner_group_id' => 2
        ]);

        \Iba\Models\PartnerGroupTranslation::create([
            'id' => 6,
            'name' => 'Group #3',
            'locale' => 'en',
            'partner_group_id' => 3
        ]);
    }
}
