<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    public function index()
    {
        return view('permissions')->with('action', 'mostrar_usuarios');
    }

    public function editar_permissoes($user_id)
    {
        return view('permissions')
            ->with('action', 'editar_permissoes')
            ->with('user_id', $user_id);
    }
}
