<?php

use Illuminate\Database\Seeder;

class PartnerImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Iba\Models\PartnerImage::create([
            'id' => 1,
            'image' => 'img-logo-abapa.jpg',
            'partner_id' => 1

        ]);

        \Iba\Models\PartnerImage::create([
            'id' => 2,
            'image' => 'img-logo-apipa.jpg',
            'partner_id' => 1
        ]);

        \Iba\Models\PartnerImage::create([
            'id' => 3,
            'image' => 'img-logo-agopa.jpg',
            'partner_id' => 2
        ]);


        \Iba\Models\PartnerImage::create([
            'id' => 4,
            'image' => 'img-logo-abapa.jpg',
            'partner_id' => 2
        ]);


        \Iba\Models\PartnerImage::create([
            'id' => 5,
            'image' => 'img-logo-apipa.jpg',
            'partner_id' => 3
        ]);


        \Iba\Models\PartnerImage::create([
            'id' => 6,
            'image' => 'img-logo-agopa.jpg',
            'partner_id' => 3
        ]);

    }
}
