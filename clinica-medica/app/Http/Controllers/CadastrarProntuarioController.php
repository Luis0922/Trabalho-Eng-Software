<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CadastrarProntuarioController extends Controller
{
    public function index(){
        return view('cadastro-prontuario');
    }
}
