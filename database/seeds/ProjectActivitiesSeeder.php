<?php

use Illuminate\Database\Seeder;
use Iba\Models\ProjectActivity;

class ProjectActivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectActivity::create([
            'id' => 1,
            'status' => '1'

        ]);

        ProjectActivity::create([
            'id' => 2,
            'status' => '1'
        ]);

        ProjectActivity::create([
            'id' => 3,
            'status' => '1'
        ]);
    }
}
