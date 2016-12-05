<?php

use Illuminate\Database\Seeder;

class FileTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO filetypes(id,icon_image, cover_image) VALUES (?,?,?)', ['1','audio.png','audio.png']);
        DB::insert('INSERT INTO filetypes(id,icon_image, cover_image) VALUES (?,?,?)', ['2','graphic.png','graphic.png']);
        DB::insert('INSERT INTO filetypes(id,icon_image, cover_image) VALUES (?,?,?)', ['3','graphic-o.png','graphic-o.png']);
        DB::insert('INSERT INTO filetypes(id,icon_image, cover_image) VALUES (?,?,?)', ['4','image.png','image.png']);
        DB::insert('INSERT INTO filetypes(id,icon_image, cover_image) VALUES (?,?,?)', ['5','presentation.png','presentation.png']);
        DB::insert('INSERT INTO filetypes(id,icon_image, cover_image) VALUES (?,?,?)', ['6','quote.png','quote.png']);
        DB::insert('INSERT INTO filetypes(id,icon_image, cover_image) VALUES (?,?,?)', ['7','sheet.png','sheet.png']);
        DB::insert('INSERT INTO filetypes(id,icon_image, cover_image) VALUES (?,?,?)', ['8','software.png','software.png']);
        DB::insert('INSERT INTO filetypes(id,icon_image, cover_image) VALUES (?,?,?)', ['9','text.png','text.png']);
        DB::insert('INSERT INTO filetypes(id,icon_image, cover_image) VALUES (?,?,?)', ['10','video.png','video.png']);
    }
}
