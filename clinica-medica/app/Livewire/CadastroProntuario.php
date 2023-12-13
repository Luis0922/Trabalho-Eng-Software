<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Paciente;
use App\Models\Prontuario;
use Carbon\Carbon;

class CadastroProntuario extends Component
{
    public $anamnese;
    public $medicamentos;
    public $atestados;
    public $exames;
    public $users;
    public $selected_user;

    protected $listeners = ['cadastro'];

    public function mount()
    {
        $this->selected_user = Paciente::first()->value('codigo');
        $this->users = Paciente::select('users.email', 'users.id')
            ->join('users', 'users.id', 'paciente.codigo')->get();
    }

    public function render()
    {
        return view('livewire.cadastro-prontuario');
    }

    public function cadastro()
    {
        $dados = ([
            'codigo' => $this->selected_user,
            'anamnese' => $this->anamnese,
            'medicamentos' => $this->medicamentos,
            'atestados' => $this->atestados,
            'exames' => $this->exames,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        return Prontuario::insert($dados);
    }
}
