<?php

use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Iba\Models\Partner::create([
            'id' => 1,
            'status' => 1,
            'partner_group_id' => 1

        ]);

        \Iba\Models\Partner::create([
            'id' => 2,
            'status' => 1,
            'partner_group_id' => 1
        ]);

        \Iba\Models\Partner::create([
            'id' => 3,
            'status' => 1,
            'partner_group_id' => 2
        ]);

        \Iba\Models\Partner::create([
            'id' => 4,
            'status' => 1,
            'partner_group_id' => 2
        ]);

        \Iba\Models\Partner::create([
            'id' => 5,
            'status' => 1,
            'partner_group_id' => 3
        ]);

        \Iba\Models\Partner::create([
            'id' => 6,
            'status' => 1,
            'partner_group_id' => 3
        ]);
    }
}
