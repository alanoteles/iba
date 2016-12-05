<?php

use Illuminate\Database\Seeder;

class ProjectYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Iba\Models\ProjectYear::create([
            'id' => 1,
            'year' => '2009',
            'project_id' => 1,

        ]);

        \Iba\Models\ProjectYear::create([
            'id' => 2,
            'year' => '2012',
            'project_id' => 2,
        ]);

        \Iba\Models\ProjectYear::create([
            'id' => 3,
            'year' => '2015',
            'project_id' => 3,
        ]);
    }
}
