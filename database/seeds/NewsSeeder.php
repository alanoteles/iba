<?php

use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Iba\Models\News::class, 10)->create()->each(function($u) {
            $u->translation()->save(factory(Iba\Models\NewsTranslation::class)->make());
            $u->images()->save(factory(Iba\Models\NewsImage::class)->make());
        });
    }
}
