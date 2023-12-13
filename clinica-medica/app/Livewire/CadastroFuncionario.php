<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BaseEnderecos;
use App\Models\Funcionario;
use App\Models\Medico;
use App\Models\User;
use Carbon\Carbon;

class CadastroFuncionario extends Component
{
    public $nome, $email, $tel, $cep, $logradouro, $bairro, $cidade, $estado, $data_inicio, $salario, $senha, $especialidade, $crm;
    public $menssagemErro = "";
    public $imprimir_medico = 0;
    public $tipo = 'secretaria';
    protected $listeners = ['cadastrar'];

    public function cadastrar()
    {
        $tratarErros = $this->Verifica();

        if ($tratarErros == 0) {

            $idUsuario = $this->cadastrarUsuario();
            $flagCadastro = $this->cadastraFuncionario($idUsuario);

            if ($this->tipo == 'medico' && $flagCadastro)
                $flagCadastro = $this->cadastraMedico($idUsuario);
            else if ($flagCadastro) {
                $this->menssagemErro = "";
            } else {
                $this->menssagemErro = "Não foi possível cadastrar o funcionário";
            }

        } else if ($tratarErros == -1) {
            //$this->menssagemErro = "Endereço de email já existente";
            dd("ja tem esse email");
        } else if ($tratarErros == -2) {
            // $this->menssagemErro = "Campos obrigatórios estão vazios";
            dd("campos obrigatorios nulos");
        }

    }

    protected function cadastrarUsuario()
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
            'telefone' => $this->tel,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return User::insertGetId($dados_usuario);

    }

    public function cadastraFuncionario($idUsuario)
    {

        $dadosFuncionario = ([
            'codigo' => $idUsuario,
            'data_contrato' => $this->data_inicio,
            'salario' => $this->salario
        ]);

        $user = User::find($idUsuario);
        $user->assignRole('secretaria');

        return Funcionario::insert($dadosFuncionario);
    }

    public function cadastraMedico($idUsuario)
    {
        $dadosMedico = ([
            'codigo' => $idUsuario,
            'especialidade' => $this->especialidade,
            'crm' => $this->crm
        ]);

        $user = User::find($idUsuario);
        $user->assignRole('medico');
        $user->removeRole('secretaria');

        return Medico::insert($dadosMedico);
    }

    public function completarEndereco()
    {

        $endereco = BaseEnderecos::select('id', 'cidade', 'bairro', 'estado', 'logradouro')
            ->where('cep', $this->cep)->get();

        $idEndereco = BaseEnderecos::where('cep', $this->cep)->value('id');

        $map = $endereco->first();

        if ($idEndereco) {
            $this->cidade = $map['cidade'];
            $this->bairro = $map['bairro'];
            $this->estado = $map['estado'];
            $this->logradouro = $map['logradouro'];
        } else {
            $this->cidade = "";
            $this->bairro = "";
            $this->estado = "";
            $this->logradouro = "";
        }
    }

    public function verifica()
    {

        if (
            $this->nome == NULL || $this->email == NULL || $this->senha == NULL ||
            $this->data_inicio == NULL || $this->salario == NULL || $this->cep == NULL ||
            $this->logradouro == NULL || $this->bairro == NULL || $this->cidade == NULL ||
            $this->estado == NULL || $this->tel == NULL
        ) {
            return -2;
        }

        $existeEmail = User::where('email', $this->email)->value('id');
        if ($existeEmail != NULL) {
            return -1;
        }

        return 0;

    }

    public function render()
    {
        return view('livewire.cadastro-funcionario');
    }

    public function designarTipoFuncionario()
    {
        if ($this->tipo == 'medico')
            $this->imprimir_medico = 1;
        else
            $this->imprimir_medico = 0;

    }

}
