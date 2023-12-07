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
        Permission::create(['name' => 'atualizar_funcao']);

        Role::create(['name' => 'admin']);
        $user = User::find(1);
        $user->assignRole('admin');
        $role = Role::findByName('admin');
        $role->givePermissionTo(Permission::all());
    }
}
