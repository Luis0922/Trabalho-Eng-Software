<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BaseEnderecos;
use Carbon\Carbon;

class Novoendereco extends Component
{
    
    public $cep, $logradouro, $bairro, $cidade, $estado;
    public $menssagemErro = "";
    protected $listeners = ['cadastrar'];


    public function cadastrar(){

        $idEndereco = BaseEnderecos::where('cep', $this->cep)
                                ->value('id');

        
        if($idEndereco == NULL && $this->verifica())
        {
            
            $dados_endereco = ([
                'cep' => $this->cep,
                'logradouro' => $this->logradouro,
                'bairro' => $this->bairro,
                'cidade' => $this->cidade,
                'estado' => $this->estado,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
    
            BaseEnderecos::insert($dados_endereco);
        }else{
            dd("Endereço já cadastrado");
        }
        
    }

    public function verifica()
    {

        if($this->cep == NULL || $this->logradouro == NULL || $this->bairro == NULL || 
           $this->cidade == NULL || $this->estado == NULL){
            return false;
        }

        return true;

    }

    public function render()
    {
        return view('livewire.novoendereco');
    }
}
