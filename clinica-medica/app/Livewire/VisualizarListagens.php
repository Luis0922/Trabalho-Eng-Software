<?php

namespace App\Livewire;

use Livewire\Component;

class VisualizarListagens extends Component
{
    public $tabela;
    public function render()
    {
        return view('livewire.visualizar-listagens');
    }
    public function escolherTabela(){
        return 0;
    }
}
