<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObjectiveVerbsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['Lembrar', NULL, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['Entender', NULL, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['Aplicar', NULL, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['Analisar', NULL, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['Avaliar', NULL, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['definir', 1, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['descrever', 1, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['distinguir', 1, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['identificar', 1, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['listar', 1, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['memorizar', 1, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['ordenar', 1, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['reconhecer', 1, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['reproduzir', 1, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['classificar', 2, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['converter', 2, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['discutir', 2, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['explicar', 2, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['generalizar', 2, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['inferir', 2, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['interpretar', 2, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['prever', 2, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['redefinir', 2, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['selecionar', 2, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['construir', 3, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['demonstrar', 3, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['empregar', 3, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['esboçar', 3, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['escolher', 3, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['escrever', 3, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['ilustrar', 3, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['interpretar', 3, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['resolver', 3, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['usar', 3, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['calcular', 3, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['analisar', 4, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['refletir', 4, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['discutir', 4, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['comparar', 4, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['discriminar', 4, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['distinguir', 4, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['examinar', 4, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['experimentar', 4, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['testar', 4, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['esquematizar', 4, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['questionar', 4, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['avaliar', 5, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['criticar', 5, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['defender', 5, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['detectar', 5, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['escolher', 5, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['estimar', 5, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['explicar', 5, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['Compreender', NULL, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['conhecer', NULL, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['conceituar', NULL, 1, 0]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['atender', 1, 1, 1]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['preferir', 1, 1, 1]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['aceitar', 1, 1, 1]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['receber', 1, 1, 1]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['perceber', 1, 1, 1]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['favorecer', 1, 1, 1]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['especificar', 2, 1, 1]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['responder', 2, 1, 1]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['completar', 2, 1, 1]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['listar', 2, 1, 1]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['escrever', 2, 1, 1]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['reconhecer', 3, 1, 1]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['participar', 3, 1, 1]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['incrementar', 3, 1, 1]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['realizar', 3, 1, 1]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['indicar', 3, 1, 1]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['decidir', 3, 1, 1]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['influenciar', 3, 1, 1]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['organizar', 4, 1, 1]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['julgar', 4, 1, 1]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['relacionar', 4, 1, 1]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['encontrar', 4, 1, 1]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['determinar', 4, 1, 1]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['correlacionar', 4, 1, 1]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['selecionar', 4, 1, 1]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['revisar', 5, 1, 1]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['modificar', 5, 1, 1]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['enfrentar', 5, 1, 1]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['desenvolver', 5, 1, 1]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['demonstrar', 5, 1, 1]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['identificar', 5, 1, 1]);
        DB::insert('INSERT INTO objective_verbs(text,verb_id,created_by,verb_type) VALUES (?,?,?,?)', ['decidir', 5, 1, 1]);
    }
}
