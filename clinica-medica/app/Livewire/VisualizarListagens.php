<?php

namespace App\Livewire;

use Livewire\Component;
use Auth;
class VisualizarListagens extends Component
{
    public $tabela;
    public $emailUsuario;
    public function render()
    {   
        return view('livewire.visualizar-listagens');
    }
    public function escolherTabela(){
        return 0;
    }
}
