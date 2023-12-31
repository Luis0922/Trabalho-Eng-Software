<?php

namespace App\Livewire;

use App\Models\Funcionario;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class FuncionarioTable extends PowerGridComponent
{
    use WithExport;

    public function setUp(): array
    {


        return [
            Footer::make()
                ->showRecordCount()
        ];
    }

    public function datasource(): Builder
    {
        return Funcionario::query()
        ->join('Users', function ($Users) { 
            $Users->on('Funcionario.codigo', '=', 'Users.id');
        })
        ->select([
            'Funcionario.salario',
            'Funcionario.data_contrato',
            'Users.name',
            'Users.email',
            'Users.cep',
            'Users.logradouro',
            'Users.telefone',
        ]);
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('salario')
            ->addColumn('data_contrato')
            ->addColumn('email')
            ->addColumn('name')
            ->addColumn('cep')
            ->addColumn('logradouro')
            ->addColumn('telefone');
    }

    public function columns(): array
    {
        return [
            Column::make('Nome', 'name'),
            Column::make('Email', 'email'),
            Column::make('Salario', 'salario'),
            Column::make('Data Contrato', 'data_contrato'),
            Column::make('CEP', 'cep'),
            Column::make('Logradouro', 'logradouro'),
            Column::make('Telefone', 'telefone')

                ->sortable(),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datetimepicker('created_at'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

//     public function actions(\App\Models\Funcionario $row): array
//     {
//         // return [
//         //     Button::add('edit')
//         //         ->slot('Edit: '.$row->id)
//         //         ->id()
//         //         ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
//         //         ->dispatch('edit', ['rowId' => $row->id])
//         // ];
//     }
//  
    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
