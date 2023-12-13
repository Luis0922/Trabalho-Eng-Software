<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BaseEnderecos;
use App\Models\User;
use App\Models\Paciente;
use Carbon\Carbon;

class CadastroPaciente extends Component
{

    public $nome, $email, $telefone, $cep, $logradouro, $bairro, $cidade, $estado, $peso, $altura, $tipoSanguineo;
    public $senha = 'da156dads16sd15ad';
    public $menssagemErro = "";
    protected $listeners = ['cadastrar'];

    public function cadastrar()
    {
        
        $tratarErros = $this->Verifica();

        if($tratarErros == 0){

            $idUsuario = $this->cadastraUsuario();
            $foi = $this->cadastraPaciente($idUsuario);

            if($foi){
                $this->menssagemErro = "";
            }else{
                $this->menssagemErro = "Não foi possível cadastrar o funcionário"; 
            }

        }else if($tratarErros == -1){
            //$this->menssagemErro = "Endereço de email já existente";
            dd("ja tem esse email");
        }else if($tratarErros == -2){
           // $this->menssagemErro = "Campos obrigatórios estão vazios";
           dd("campos obrigatorios nulos");
        }
    }

    public function cadastraUsuario()
    {

        $dados_usuario = ([
            'name' => $this->nome,
            'email' => $this->email,
            'password' => bcrypt($this->senha),
            'cep' => $this->cep,
            'logradouro' => $this->logradouro,
            'bairro' => $this->bairro,
            'cidade' => $this->cidade,
            'estado' => $this->estado,
            'telefone' => $this->telefone,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return User::insertGetId($dados_usuario);

    }

    public function cadastraPaciente($idUsuario)
    {

        $dadosPaciente = ([
            'codigo' => $idUsuario,
            'peso' => $this->peso,
            'altura' => $this->altura,
            'tipo_sanguineo' => $this->tipoSanguineo
        ]);

        return Paciente::insert($dadosPaciente);

    }

    public function verifica()
    {
        
        if($this->nome == NULL || $this->email == NULL || $this->senha == NULL || 
           $this->cep == NULL || $this->logradouro == NULL || $this->bairro == NULL || 
           $this->cidade == NULL || $this->estado == NULL || $this->telefone == NULL ||
           $this->peso == NULL || $this->altura == NULL || $this->tipoSanguineo == NULL)
        {
            return -2;
        }

        $existeEmail = User::where('email', $this->email)->value('id');
        if($existeEmail != NULL){
            return -1;
        }
        
        return 0;

    }

    public function completarEndereco()
    {

        $endereco = BaseEnderecos::select('id','cidade','bairro','estado','logradouro')
                                ->where('cep', $this->cep)->get();

        $idEndereco = BaseEnderecos::where('cep', $this->cep)->value('id');

        $map = $endereco->first();

        if($idEndereco){
            $this->cidade = $map['cidade'];
            $this->bairro = $map['bairro'];
            $this->estado = $map['estado'];
            $this->logradouro = $map['logradouro'];
        }else{
            $this->cidade = "";
            $this->bairro = "";
            $this->estado = "";
            $this->logradouro = "";
        }
    }

    public function render()
    {
        return view('livewire.cadastro-paciente');
    }
}
