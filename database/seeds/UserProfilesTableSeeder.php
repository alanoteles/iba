<?php

use Illuminate\Database\Seeder;
use Iba\Models\UserProfile;

class UserProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserProfile::create([
            'id' => 1,
            'name' => 'Administrador',
            'weight' => 1,
            'show_state' => 0,
            'status' => 1
        ]);

        UserProfile::create([
            'id' => 3,
            'name' => 'Regional',
            'weight' => 200,
            'show_state' => 1,
            'status' => 1
        ]);

        UserProfile::create([
            'id' => 5,
            'name' => 'Padrão',
            'weight' => 999,
            'show_state' => 0,
            'status' => 1
        ]);
    }
}
