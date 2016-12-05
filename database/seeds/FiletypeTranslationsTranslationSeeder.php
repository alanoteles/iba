<?php

use Illuminate\Database\Seeder;

class FiletypeTranslationsTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO filetype_translations(id,type,alt_image,alt_cover,locale,filetype_id) VALUES (?,?,?,?,?,?)', ['1','Audio','audio.png','audio.png','pt_br','1']);
        DB::insert('INSERT INTO filetype_translations(id,type,alt_image,alt_cover,locale,filetype_id) VALUES (?,?,?,?,?,?)', ['2','Gráfico','graphic.png','graphic.png','pt_br','2']);
        DB::insert('INSERT INTO filetype_translations(id,type,alt_image,alt_cover,locale,filetype_id) VALUES (?,?,?,?,?,?)', ['3','Infográfico','graphic-o.png','graphic-o.png','pt_br','3']);
        DB::insert('INSERT INTO filetype_translations(id,type,alt_image,alt_cover,locale,filetype_id) VALUES (?,?,?,?,?,?)', ['4','Imagem','image.png','image.png','pt_br','4']);
        DB::insert('INSERT INTO filetype_translations(id,type,alt_image,alt_cover,locale,filetype_id) VALUES (?,?,?,?,?,?)', ['5','Apresentação','presentation.png','presentation.png','pt_br','5']);
        DB::insert('INSERT INTO filetype_translations(id,type,alt_image,alt_cover,locale,filetype_id) VALUES (?,?,?,?,?,?)', ['6','Citação','quote.png','quote.png','pt_br','6']);
        DB::insert('INSERT INTO filetype_translations(id,type,alt_image,alt_cover,locale,filetype_id) VALUES (?,?,?,?,?,?)', ['7','Planilha','sheet.png','sheet.png','pt_br','7']);
        DB::insert('INSERT INTO filetype_translations(id,type,alt_image,alt_cover,locale,filetype_id) VALUES (?,?,?,?,?,?)', ['8','Software','software.png','software.png','pt_br','8']);
        DB::insert('INSERT INTO filetype_translations(id,type,alt_image,alt_cover,locale,filetype_id) VALUES (?,?,?,?,?,?)', ['9','Texto','text.png','text.png','pt_br','9']);
        DB::insert('INSERT INTO filetype_translations(id,type,alt_image,alt_cover,locale,filetype_id) VALUES (?,?,?,?,?,?)', ['10','Vídeo','video.png','video.png','pt_br','10']);
    }
}
