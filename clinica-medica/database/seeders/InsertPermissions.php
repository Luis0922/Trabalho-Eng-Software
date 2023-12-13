<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class InsertPermissions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'cadastro_funcionario']);
        Permission::create(['name' => 'editar_permissoes']);
        Permission::create(['name' => 'atualizar_funcao']);
        Permission::create(['name' => 'adicionar_funcao_usuario']);
        Permission::create(['name' => 'atualizar_funcao_usuario']);
        Permission::create(['name' => 'adicionar_permissao_usuario']);
        Permission::create(['name' => 'atualizar_permissao_usuario']);
        Permission::create(['name' => 'visualizar_home']);
        Permission::create(['name' => 'visualizar_galeria']);
        Permission::create(['name' => 'realizar_agendamento']);
        Permission::create(['name' => 'cadastrar_endereco']);
        Permission::create(['name' => 'cadastrar_paciente']);
        Permission::create(['name' => 'cadastrar_prontuario']);
        Permission::create(['name' => 'visualizar_listagens']);
        Permission::create(['name' => 'visualizar_meus_agendamentos']);
        Permission::create(['name' => 'visualizar_agendamentos']);




        $role = Role::create(['name' => 'medico']);
        $role->givePermissionTo('visualizar_home');
        $role->givePermissionTo('visualizar_galeria');
        $role->givePermissionTo('realizar_agendamento');
        $role->givePermissionTo('cadastrar_paciente');
        $role->givePermissionTo('cadastrar_prontuario');
        $role->givePermissionTo('visualizar_listagens');
        $role->givePermissionTo('visualizar_meus_agendamentos');

        $role = Role::create(['name' => 'secretaria']);
        $role->givePermissionTo('visualizar_home');
        $role->givePermissionTo('cadastro_funcionario');
        $role->givePermissionTo('visualizar_galeria');
        $role->givePermissionTo('realizar_agendamento');
        $role->givePermissionTo('cadastrar_endereco');
        $role->givePermissionTo('cadastrar_paciente');
        $role->givePermissionTo('visualizar_listagens');
        $role->givePermissionTo('visualizar_agendamentos');

        Role::create(['name' => 'admin']);
        $user = User::find(1);
        $user->assignRole('admin');
        $role = Role::findByName('admin');
        $role->givePermissionTo(Permission::all());
    }
}
