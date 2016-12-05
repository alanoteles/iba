<?php

use Illuminate\Database\Seeder;

class CmsHighlightsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //-- Notícias Home --//
        for($x=1; $x<=4; $x++){

            \Iba\Models\CmsHighlight::create([
                'module'    => 'noticias',
                'page'      => 'home',
                'position'  => 'h' . $x,
                'record_id' => $x,

            ]);
        }

        //-- Notícias Interna --//
        for($x=1; $x<=6; $x++){

            \Iba\Models\CmsHighlight::create([
                'module'    => 'noticias',
                'page'      => 'interna',
                'position'  => 'p' . $x,
                'record_id' => $x,

            ]);
        }


        //-- Projetos  --//
        for($x=1; $x<=2; $x++){

            \Iba\Models\CmsHighlight::create([
                'module'    => 'projetos',
                'page'      => 'home',
                'position'  => 'p' . $x,
                'record_id' => $x,

            ]);

            \Iba\Models\CmsHighlight::create([
                'module'    => 'projetos',
                'page'      => 'interna',
                'position'  => 'p' . $x,
                'record_id' => $x,

            ]);
        }
    }
}
