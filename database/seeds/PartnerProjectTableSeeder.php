<?php

use Illuminate\Database\Seeder;

class PartnerProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO partner_projects(id, type, project_id) VALUES (?,?,?)', ['1', 'proponente', '1', '1']);
        DB::insert('INSERT INTO partner_projects(id, type, project_id) VALUES (?,?,?)', ['2', 'proponente', '2', '2']);
        DB::insert('INSERT INTO partner_projects(id, type, project_id) VALUES (?,?,?)', ['3', 'proponente', '3', '3']);
        DB::insert('INSERT INTO partner_projects(id, type, project_id) VALUES (?,?,?)', ['1', 'executor', '1', '2']);
        DB::insert('INSERT INTO partner_projects(id, type, project_id) VALUES (?,?,?)', ['1', 'executor', '2', '1']);
        DB::insert('INSERT INTO partner_projects(id, type, project_id) VALUES (?,?,?)', ['1', 'executor', '3', '2']);
        DB::insert('INSERT INTO partner_projects(id, type, project_id) VALUES (?,?,?)', ['1', 'proponente', '4', '2']);
        DB::insert('INSERT INTO partner_projects(id, type, project_id) VALUES (?,?,?)', ['1', 'proponente', '5', '1']);
        DB::insert('INSERT INTO partner_projects(id, type, project_id) VALUES (?,?,?)', ['1', 'proponente', '6', '2']);
    }
}
