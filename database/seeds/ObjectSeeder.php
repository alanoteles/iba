<?php

use Illuminate\Database\Seeder;

class ObjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

//        DB::table('objects')->insert([
//            'issn' => 'ISSN #1',
//            'license_id' => 1,
//            'type_id' => 1,
//            'filetype_id' => 1,
//            'thread_id' => 1,
//            'topic_id' => 1,
//            'subtopic_id' => 1,
//            'created_by' => 1
//        ]);
//
//        DB::table('objects')->insert([
//            'issn' => 'ISSN #1',
//            'license_id' => 1,
//            'type_id' => 1,
//            'filetype_id' => 1,
//            'thread_id' => 1,
//            'topic_id' => 1,
//            'subtopic_id' => 1,
//            'created_by' => 1
//        ]);

        factory(Iba\Models\Object::class, 10)->create()->each(function($u) {
            $u->object_translation()->save(factory(Iba\Models\ObjectTranslation::class)->make());
        });
    }
}
