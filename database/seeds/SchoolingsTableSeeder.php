<?php

use Illuminate\Database\Seeder;
use Iba\Models\Schooling;

class SchoolingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schooling::create([
            'order' => 0,
            'created_by' => 1
        ]);

        Schooling::create([
            'order' => 1,
            'created_by' => 1
        ]);

        Schooling::create([
            'order' => 2,
            'created_by' => 1
        ]);

        Schooling::create([
            'order' => 3,
            'created_by' => 1
        ]);

        Schooling::create([
            'order' => 4,
            'created_by' => 1
        ]);

        Schooling::create([
            'order' => 5,
            'created_by' => 1
        ]);

        Schooling::create([
            'order' => 6,
            'created_by' => 1
        ]);

        Schooling::create([
            'order' => 7,
            'created_by' => 1
        ]);

        Schooling::create([
            'order' => 8,
            'created_by' => 1
        ]);
    }
}
