<?php

use Illuminate\Database\Seeder;

class AttachmentObjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO attachment_object(id, object_id, attachment_id, created_by) VALUES (?,?,?, ?)', ['1', '1', '1', '1']);
        DB::insert('INSERT INTO attachment_object(id, object_id, attachment_id, created_by) VALUES (?,?,?, ?)', ['4', '10', '2', '1']);
        DB::insert('INSERT INTO attachment_object(id, object_id, attachment_id, created_by) VALUES (?,?,?, ?)', ['5', '2', '3', '1']);
        DB::insert('INSERT INTO attachment_object(id, object_id, attachment_id, created_by) VALUES (?,?,?, ?)', ['7', '3', '4', '1']);
        DB::insert('INSERT INTO attachment_object(id, object_id, attachment_id, created_by) VALUES (?,?,?, ?)', ['8', '4', '2', '1']);
        DB::insert('INSERT INTO attachment_object(id, object_id, attachment_id, created_by) VALUES (?,?,?, ?)', ['9', '5', '1', '1']);
        DB::insert('INSERT INTO attachment_object(id, object_id, attachment_id, created_by) VALUES (?,?,?, ?)', ['10', '6', '2', '1']);
        DB::insert('INSERT INTO attachment_object(id, object_id, attachment_id, created_by) VALUES (?,?,?, ?)', ['11', '7', '3', '1']);
        DB::insert('INSERT INTO attachment_object(id, object_id, attachment_id, created_by) VALUES (?,?,?, ?)', ['12', '8', '4', '1']);

    }
}
