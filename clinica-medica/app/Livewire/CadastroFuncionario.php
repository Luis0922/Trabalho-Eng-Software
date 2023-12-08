<?php

namespace App\Livewire;

use Livewire\Component;

class CadastroFuncionario extends Component
{
    public $nome;
    
    public function render()
    {
        return view('livewire.cadastro-funcionario');
    }
}
