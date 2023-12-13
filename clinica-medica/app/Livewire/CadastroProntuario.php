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
        $tratarErros = $this->Verifica();

        if($tratarErros == 0){

            $foi = $this->cadastraProntuario();

            if($foi){
                $this->menssagemErro = "";
            }else{
                $this->menssagemErro = "Não foi possível cadastrar o funcionário"; 
            }

        }else if($tratarErros == -2){
           // $this->menssagemErro = "Campos obrigatórios estão vazios";
           dd("campos obrigatorios nulos");
        }
    }

    public function cadastraProntuario()
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

    public function verifica()
    {
        
        if($this->anamnese == NULL || $this->medicamentos == NULL || $this->atestados == NULL || 
           $this->exames == NULL || $this->selected_user == NULL)
        {
            return -2;
        }
        
        return 0;

    }
}
