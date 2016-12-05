<?php

use Illuminate\Database\Seeder;
use Iba\Models\ProjectType;

class ProjectTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectType::create([
            'id' => 1,
            'status' => '1'

        ]);

        ProjectType::create([
            'id' => 2,
            'status' => '1'
        ]);

        ProjectType::create([
            'id' => 3,
            'status' => '1'
        ]);
    }
}
