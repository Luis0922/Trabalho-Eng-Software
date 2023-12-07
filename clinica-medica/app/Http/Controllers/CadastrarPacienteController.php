<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CadastrarPacienteController extends Controller
{
    public function index(){
        return view('cadastro-paciente');
    }
}
