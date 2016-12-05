<?php

use Illuminate\Database\Seeder;
use Iba\Models\UserDetail;

class UserDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserDetail::create([
            'id' => 1,
            'user_id' => 1,
            'city_id' => 1724, //Brasília
            'avatar' => '',
            'document' => '11111111123',
            'birthday' => '2016-03-03',
            'locale' => 'pt_br',
            'address' => 'CLN 102 Bloco C Sala',
            'number' => '101',
            'zip' => '70752530',
            'neighborhood' => 'Asa Norte',
            'complement' => 'Acima da Casa das Artes',
            'mobile_phone' => '6130810090'
        ]);
    }
}
