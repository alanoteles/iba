<?php

use Illuminate\Database\Seeder;
use Iba\Models\UserGroup;

class UserGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserGroup::create([
            'id' => 1,
            'user_profile_id' => 1,
            'name' => '[Sistema] Grupo Administrador',
            'description' => 'Grupo padrão do sistema Banco de Conhecimento/Portal para Administradores. Não pode ser excluído [id 1]',
            'view_object' => 1,
            'seal_object' => 1,
            'create_object' => 1,
            'status' => 1
        ]);

        UserGroup::create([
            'id' => 2,
            'user_profile_id' => 5,
            'name' => '[Sistema] Grupo Padrão',
            'description' => 'Grupo padrão com perfil mais baixo do sistema banco de conhecimento. Não pode ser excluído [id 2]',
            'view_object' => 0,
            'seal_object' => 0,
            'create_object' => 0,
            'status' => 1
        ]);
    }
}
