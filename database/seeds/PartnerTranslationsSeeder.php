<?php

use Illuminate\Database\Seeder;

class PartnerTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Iba\Models\PartnerTranslation::create([
            'id' => 1,
            'name' => 'Assoc. ABC [pt]',
            'acronym' => 'ABC [pt]',
            'summary' => 'Donec eget porta odio. Suspendisse a ligula at tortor congue commodo ut in lacus. In nibh urna, rutrum ac luctus vestibulum, sagittis vitae justo.',
            'url' => 'www.abc.com/pt',
            'content' => 'Fusce blandit rhoncus magna suscipit fringilla. Vestibulum vitae velit justo. Maecenas vitae tristique nunc. Cras hendrerit non magna scelerisque commodo.',
            'locale' => 'pt_br',
            'partner_id' => 1
        ]);


        \Iba\Models\PartnerTranslation::create([
            'id' => 2,
            'name' => 'Assoc. CDE [pt]',
            'acronym' => 'CDE [pt]',
            'summary' => 'Donec eget porta odio. Suspendisse a ligula at tortor congue commodo ut in lacus. In nibh urna, rutrum ac luctus vestibulum, sagittis vitae justo.',
            'url' => 'www.cde.com/pt',
            'content' => 'Fusce blandit rhoncus magna suscipit fringilla. Vestibulum vitae velit justo. Maecenas vitae tristique nunc. Cras hendrerit non magna scelerisque commodo.',
            'locale' => 'pt_br',
            'partner_id' => 2
        ]);


        \Iba\Models\PartnerTranslation::create([
            'id' => 3,
            'name' => 'Assoc. ABC [en]',
            'acronym' => 'ABC [en]',
            'summary' => 'Donec eget porta odio. Suspendisse a ligula at tortor congue commodo ut in lacus. In nibh urna, rutrum ac luctus vestibulum, sagittis vitae justo.',
            'url' => 'www.abc.com/en',
            'content' => 'Fusce blandit rhoncus magna suscipit fringilla. Vestibulum vitae velit justo. Maecenas vitae tristique nunc. Cras hendrerit non magna scelerisque commodo.',
            'locale' => 'pt_br',
            'partner_id' => 3
        ]);


        \Iba\Models\PartnerTranslation::create([
            'id' => 4,
            'name' => 'Assoc. CDE [en]',
            'acronym' => 'CDE [en]',
            'summary' => 'Donec eget porta odio. Suspendisse a ligula at tortor congue commodo ut in lacus. In nibh urna, rutrum ac luctus vestibulum, sagittis vitae justo.',
            'url' => 'www.cde.com/en',
            'content' => 'Fusce blandit rhoncus magna suscipit fringilla. Vestibulum vitae velit justo. Maecenas vitae tristique nunc. Cras hendrerit non magna scelerisque commodo.',
            'locale' => 'en',
            'partner_id' => 4
        ]);


        \Iba\Models\PartnerTranslation::create([
            'id' => 5,
            'name' => 'Assoc. ABC [es]',
            'acronym' => 'ABC [es]',
            'summary' => 'Donec eget porta odio. Suspendisse a ligula at tortor congue commodo ut in lacus. In nibh urna, rutrum ac luctus vestibulum, sagittis vitae justo.',
            'url' => 'www.abc.com/es',
            'content' => 'Fusce blandit rhoncus magna suscipit fringilla. Vestibulum vitae velit justo. Maecenas vitae tristique nunc. Cras hendrerit non magna scelerisque commodo.',
            'locale' => 'es',
            'partner_id' => 5
        ]);


        \Iba\Models\PartnerTranslation::create([
            'id' => 6,
            'name' => 'Assoc. CDE [es]',
            'acronym' => 'CDE [es]',
            'summary' => 'Donec eget porta odio. Suspendisse a ligula at tortor congue commodo ut in lacus. In nibh urna, rutrum ac luctus vestibulum, sagittis vitae justo.',
            'url' => 'www.cde.com/es',
            'content' => 'Fusce blandit rhoncus magna suscipit fringilla. Vestibulum vitae velit justo. Maecenas vitae tristique nunc. Cras hendrerit non magna scelerisque commodo.',
            'locale' => 'es',
            'partner_id' => 6
        ]);



    }
}
