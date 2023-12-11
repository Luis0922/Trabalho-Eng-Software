<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    public function index()
    {
        return view('permissions')
            ->with('action', 'mostrar_usuarios')
            ->with('mostrar_opcao', 'true');
    }

    public function atualizar_funcao()
    {
        return view('permissions')
            ->with('action', 'atualizar_funcao')
            ->with('mostrar_opcao', 'true');
    }

    public function editar_permissoes($user_id)
    {
        return view('permissions')
            ->with('action', 'editar_permissoes')
            ->with('mostrar_opcao', 'false')
            ->with('user_id', $user_id);
    }
}
