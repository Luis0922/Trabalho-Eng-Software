<?php

namespace App\Livewire;

use App\Models\Agenda;
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

final class AgendamentosTable extends PowerGridComponent
{
    use WithExport;

    public function setUp(): array
    {
        return [
            Footer::make()
                ->showPerPage(),
        ];
    }

    public function datasource(): Builder
    {
        return Agenda::query();
        // ->join('Paciente', function ($Paciente) { 
        //     $Paciente->on('Age.codigo', '=', 'Users.id');
        // })
        // ->select([
        //     'Funcionario.id',
        //     'Funcionario.salario',
        //     'Funcionario.data_contrato',
        //     'Users.name',
        //     'Users.email',
        //     'Users.cep',
        //     'Users.logradouro',
        //     'Users.telefone',
        // ]);
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('data')
            ->addColumn('paciente')
            ->addColumn('medico')
            ->addColumn('especialidade')
            ;
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Data', 'data'),
            Column::make('Paciente', 'paciente'),
            Column::make('Medico', 'medico'),
            Column::make('Especialidade', 'especialidade')
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
