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

    public $email, $especialidadeAtual, $nomeMedico, $dataEscolhida, $horarioEscolhido, $codMed;
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
        $this->codMed = Medico::join('funcionario','medico.codigo', '=', 'funcionario.codigo')->
        join('users', 'funcionario.codigo', '=', 'users.id')->
        where('users.name', $this->nomeMedico)->value('medico.codigo');
        $this->horariosOcupados = Agenda::where('medico', $this->codMed)->where('data',$this->dataEscolhida)
                                        ->pluck('horario')->toArray();
        $temp = array_diff($this->horarios, $this->horariosOcupados);
        $this->horariosPossiveis = [];
        $i = 0;
        foreach($temp as $elemento)
        {
            $this->horariosPossiveis[$i] = $elemento;
            $i++;
        }
        $this->horarioEscolhido = $this->horariosPossiveis[0];
    }

    public function cadastra()
    {
        $nome = User::where('email', $this->email)->value('name');
        $dados = ([
            'data' => $this->dataEscolhida,
            'horario' => $this->horarioEscolhido,
            'nome' => $nome,
            'email' => $this->email,
            'medico' => $this->codMed
        ]);
        Agenda::insert($dados);
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
