<?php

use Illuminate\Database\Seeder;

class ProjectPartnersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Iba\Models\ProjectPartner::create([
            'id' => 1,
            'type' => '',
            'project_id' => 1,
            'partner_id' => 1

        ]);


        \Iba\Models\ProjectPartner::create([
            'id' => 2,
            'type' => '',
            'project_id' => 2,
            'partner_id' => 2

        ]);


        \Iba\Models\ProjectPartner::create([
            'id' => 3,
            'type' => '',
            'project_id' => 3,
            'partner_id' => 3

        ]);
    }
}
