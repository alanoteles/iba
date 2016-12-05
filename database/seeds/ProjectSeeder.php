<?php

use Illuminate\Database\Seeder;
use Iba\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::create([
            'id' => 1,
            'number' => 1,
            'meeting_date' => '2016-02-01',
            'implementation_period_start' => '2016-02-11',
            'implementation_period_end' => '2016-03-21',
            'project_value' => '2050000',
            'status' => 1,
            'project_type_id' => 1,
            'project_situation_id' => 1,
            'project_activity_id' => 1,
        ]);


        Project::create([
            'id' => 2,
            'number' => 2,
            'meeting_date' => '2016-01-01',
            'implementation_period_start' => '2016-03-30',
            'implementation_period_end' => '2016-04-21',
            'project_value' => '6800000',
            'status' => 1,
            'project_type_id' => 2,
            'project_situation_id' => 2,
            'project_activity_id' => 2,
        ]);


        Project::create([
            'id' => 3,
            'number' => 3,
            'meeting_date' => '2016-02-05',
            'implementation_period_start' => '2016-02-15',
            'implementation_period_end' => '2016-03-15',
            'project_value' => '7230000',
            'status' => 1,
            'project_type_id' => 3,
            'project_situation_id' => 3,
            'project_activity_id' => 3,
        ]);
    }
}
