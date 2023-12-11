<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class TelaPermissoes extends Component
{
    public $user_id;
    public $user;
    public $roles;
    public $action = 'permissions';
    public $selectedFuncao;
    public $roles_colunas = [];
    public $permissions_colunas = [];


    public function index()
    {
        return view('livewire.tela-permissoes');
    }

    public function render()
    {
        return view('livewire.tela-permissoes');
    }

    public function mount()
    {
        if($this->action == 'permissions'){
            $this->find_user();
            if(Auth::user()->hasPermissionTo('adicionar_permissao_usuario')){
                $this->fetch_permissions();
            }
        }
        if($this->action == 'funcao'){
            $this->roles_colunas = [];
            $roles = Role::pluck('name')->toArray();
            foreach($roles as $role){
                array_push($this->roles_colunas, ['nome' => $role]);
            }
        }
    }

    public function fetch_permissions_funcao()
    {
        $this->permissions_colunas = [];
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
    }

    public function tela_funcao()
    {
        $this->find_user();
        $this->action = 'roles';
        if(Auth::user()->hasPermissionTo('adicionar_funcao_usuario')){
            $this->fetch_roles();
        }
    }

    public function find_user()
    {
        $this->user = User::withTrashed()->where('id', $this->user_id)->first();
    }

    public function fetch_permissions()
    {
        $this->permissions_colunas = [];
        # Todas as roles do usuario
        $roles = $this->user->getRoleNames();
        $role_permission = [];
        foreach ($roles as $roleName) {
            // Encontre a função (role) pelo nome
            $role = Role::findByName($roleName, 'web');
            
            // Obtenha todas as permissões da função (role)
            $rolePermissions = $role->permissions;
            foreach($rolePermissions as $permission){
                array_push($role_permission, $permission->name);
            }
        }
        # Todas as permissoes do sistema
        $permissions = Permission::pluck('name')->toArray();
        foreach($permissions as $permission){
            $ativo = '';
            if($this->user->hasPermissionTo($permission)){
                $ativo = 'checked';
            }
            $disable = '';
            if(in_array($permission, $role_permission))
            {
                $disable = 'disabled';
            }
            array_push($this->permissions_colunas, ['nome' => $permission, 'ativo' => $ativo, 'disable' => $disable]);
        }
    }

    public function fetch_roles()
    {
        $this->roles_colunas = [];
        $roles = Role::pluck('name')->toArray();
        foreach($roles as $role){
            $ativo = '';
            if($this->user->hasRole($role)){
                $ativo = 'checked';
            }
            array_push($this->roles_colunas, ['nome' => $role, 'ativo' => $ativo]);
        }
    }

    public function atualizar_funcao($funcao)
    {
        if(Auth::user()->hasPermissionTo('atualizar_funcao')){
            $this->selectedFuncao = $funcao;
            $this->action = 'atualizar_funcao';
            $this->fetch_permissions_funcao();
        }
    }

    public function change_user_role($role)
    {
        if(Auth::user()->hasPermissionTo('atualizar_funcao_usuario')){
            if($this->user->hasRole($role)){
                $this->user->removeRole($role);
            }
            else{
                $this->user->assignRole($role);
            }
        }
    }

    public function change_user_permission($permission)
    {
        if(Auth::user()->hasPermissionTo('atualizar_permissao_usuario')){
            if($this->user->hasPermissionTo($permission)){
                $this->user->revokePermissionTo($permission);
            }
            else{
                $this->user->givePermissionTo($permission);
            }
        }
    }

    public function change_role_permission($permission)
    {
        $role = Role::findByName($this->selectedFuncao, 'web');
        if(Auth::user()->hasPermissionTo('atualizar_permissao_usuario')){
            if($role->hasPermissionTo($permission)){
                $role->revokePermissionTo($permission);
            }
            else{
                $role->givePermissionTo($permission);
            }
        }
    }
}
