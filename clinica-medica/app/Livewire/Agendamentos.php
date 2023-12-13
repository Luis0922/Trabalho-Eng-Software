<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Medico;
use App\Models\Funcionario;
use App\Models\Agenda;
use App\Models\User;
use Carbon\Carbon;

class Agendamentos extends Component
{

    public $email, $especialidadeAtual, $nomeMedico, $dataEscolhida, $horarioEscolhido;
    public $especialidadeMedica = [];
    public $medicosNaArea = [];
    public $horarios = ['8:00','9:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00'];
    public $horariosPossiveis = [], $horariosOcupados = [];

    public function mount()
    {
        $this->especialidadeMedica = Medico::distinct()->pluck('Especialidade')->toArray();
        $this->medicosNaArea = Medico::join('funcionario','medico.codigo', '=', 'funcionario.codigo')->
                       join('users', 'funcionario.codigo', '=', 'users.id')->
                       where('Especialidade', $this->especialidadeMedica[0])->pluck('users.name')->toArray();
        $this->especialidadeAtual = $this->especialidadeMedica[0];
        $this->nomeMedico = $this->medicosNaArea[0];
    }

    public function dataDefinida()
    {
        $cod = Medico::join('funcionario','medico.codigo', '=', 'funcionario.codigo')->
        join('users', 'funcionario.codigo', '=', 'users.id')->
        where('users.name', $this->nomeMedico)->value('medico.codigo');
        $this->horariosOcupados = Agenda::where('medico', $cod)->where('data',$this->dataEscolhida)
                                        ->pluck('horario')->toArray();
        $this->horariosPossiveis = array_diff($this->horarios, $this->horariosOcupados);
    }

    public function agenda()
    {
        dd($this->horarioEscolhido);
    }
    
    public function especialidadeSelecionada()
    {   
        $this->medicosNaArea = Medico::join('funcionario','medico.codigo', '=', 'funcionario.codigo')->
                                       join('users', 'funcionario.codigo', '=', 'users.id')->
                                       where('Especialidade', $this->especialidadeAtual)->pluck('users.name')->toArray();
    }

    public function render()
    {
        return view('livewire.agendamentos');
    }


}
