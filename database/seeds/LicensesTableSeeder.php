<?php

use Illuminate\Database\Seeder;

class LicensesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Iba\Models\License::create([
            'id' => 1

        ]);

        \Iba\Models\License::create([
            'id' => 2
        ]);

        \Iba\Models\License::create([
            'id' => 3
        ]);

        \Iba\Models\License::create([
            'id' => 4
        ]);

        \Iba\Models\License::create([
            'id' => 5
        ]);

        \Iba\Models\License::create([
            'id' => 6
        ]);
    }
}
