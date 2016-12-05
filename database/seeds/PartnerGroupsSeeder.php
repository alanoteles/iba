<?php

use Illuminate\Database\Seeder;

class PartnerGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Iba\Models\PartnerGroup::create([
            'id' => 1,
            'status' => 1

        ]);

        \Iba\Models\PartnerGroup::create([
            'id' => 2,
            'status' => 0
        ]);

        \Iba\Models\PartnerGroup::create([
            'id' => 3,
            'status' => 1
        ]);


    }
}
