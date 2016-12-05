<?php

use Illuminate\Database\Seeder;
use Iba\Models\ProjectSituation;

class ProjectSituationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectSituation::create([
            'id' => 1,
            'status' => '1'

        ]);

        ProjectSituation::create([
            'id' => 2,
            'status' => '1'
        ]);

        ProjectSituation::create([
            'id' => 3,
            'status' => '1'
        ]);
    }
}
