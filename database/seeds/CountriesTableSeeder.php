<?php

use Illuminate\Database\Seeder;
use Iba\Models\Country;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create([
            'name' => 'Brasil',
            'code' => 'pt-BR'
        ]);
    }
}
