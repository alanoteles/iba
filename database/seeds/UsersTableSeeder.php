<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Iba\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id' => 1,
            'user_group_id' => 1,
            'name' => 'Administrador do sistema',
            'email' => 'admin@locness.com.br',
            'password' => Hash::make('12345'),
            'status' => 1
        ]);
    }
}
