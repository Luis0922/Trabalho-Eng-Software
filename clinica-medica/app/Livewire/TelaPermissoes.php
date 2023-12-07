<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class TelaPermissoes extends Component
{
    public $user;
    public $roles;
    public $action = '';
    public $selectedFuncao;
    public $permissions_colunas = [];

    public function render()
    {
        return view('livewire.tela-permissoes');
    }

    public function mount()
    {
        if(Auth::user()->hasPermissionTo('atualizar_funcao')){
            $this->fetch_roles();
        }
    }

    public function fetch_permissions()
    {
        # Todas as permissoes do sistema
        $permissions = Permission::pluck('name')->toArray();
        $role = Role::findByName($this->selectedFuncao, 'web');
        foreach($permissions as $permission){
            $ativo = '';
            if($role->hasPermissionTo($permission)){
                $ativo = 'checked';
            }
            array_push($this->permissions_colunas, ['nome' => $permission, 'ativo' => $ativo]);
        }
        dd($this->permissions_colunas);
    }

    public function fetch_roles()
    {
        $this->roles = Role::pluck('name')->toArray();
    }

    public function atualizar_funcao($funcao)
    {
        if(Auth::user()->hasPermissionTo('atualizar_funcao')){
            $this->selectedFuncao = $funcao;
            $this->action = 'atualizar_funcao';
            $this->fetch_permissions();
        }
    }

    public function change_role_permission($permission)
    {
        $role = Role::findByName($this->selectedFuncao, 'web');
        if(Auth::user()->hasPermissionTo('controle.atualizar_permissao_usuario')){
            if($role->hasPermissionTo($permission)){
                $role->revokePermissionTo($permission);
            }
            else{
                $role->givePermissionTo($permission);
            }
        }
    }
}
