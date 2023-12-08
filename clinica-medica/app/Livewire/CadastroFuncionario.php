<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BaseEnderecos;
use App\Models\Funcionario;
use App\Models\User;
use Carbon\Carbon;

class CadastroFuncionario extends Component
{
    public $nome, $email, $tel, $cep, $logradouro, $bairro, $cidade, $estado, $data_inicio, $salario, $senha;
    public $menssagemErro = "";
    protected $listeners = ['cadastrar'];

    public function cadastrar()
    {

        $tratarErros = $this->Verifica();

        if($tratarErros == 0){

            $idEndereco = $this->cadastraEndereco();
            $idUsuario = $this->cadastrarUsuario($idEndereco);
            $foi = $this->cadastraFuncionario($idUsuario);

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
    
    public function cadastraEndereco()
    {
        $idEndereco = BaseEnderecos::where('cep', $this->cep)
                                ->where('logradouro', $this->logradouro)
                                ->value('id');
        if($idEndereco == NULL){
            
            $dados_endereco = ([
                'cep' => $this->cep,
                'logradouro' => $this->logradouro,
                'bairro' => $this->bairro,
                'cidade' => $this->cidade,
                'estado' => $this->estado,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
    
            return BaseEnderecos::insertGetId($dados_endereco);

        }
        
        return $idEndereco;

    }

    protected function cadastrarUsuario($idEndereco)
    {

        $dados_usuario = ([
            'name' => $this->nome,
            'email' => $this->email,
            'password' => bcrypt($this->senha),
            'telefone' => $this->tel,
            'codigo_endereco'=> $idEndereco,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return User::insertGetId($dados_usuario);

    }

    public function cadastraFuncionario($idUsuario){
        
        $dadosFuncionario = ([
            'codigo' => $idUsuario,
            'data_contrato' => $this->data_inicio,
            'salario' => $this->salario
        ]);
        
        return Funcionario::insert($dadosFuncionario);
    }

    public function verifica(){
        
        if($this->nome == NULL || $this->email == NULL || $this->senha == NULL || 
           $this->data_inicio == NULL || $this->salario == NULL || $this->cep == NULL ||
           $this->logradouro == NULL || $this->bairro == NULL || $this->cidade == NULL ||
           $this->estado == NULL){
            return -2;
        }

        $existeEmail = User::where('email', $this->email)->value('id');
        if($existeEmail != NULL){
            return -1;
        }
        
        return 0;

    }
    public function render()
    {
        return view('livewire.cadastro-funcionario');
    }

}
