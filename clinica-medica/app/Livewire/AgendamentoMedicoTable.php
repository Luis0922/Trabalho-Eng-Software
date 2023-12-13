<?php

namespace App\Livewire;

use App\Models\Agenda;
use Auth;
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

final class AgendamentoMedicoTable extends PowerGridComponent
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
        return Agenda::query()
        ->join('Users as UsersPaciente', function ($Users) { 
            $Users->on('Agenda.email', '=', 'UsersPaciente.email');
        }) -> join('Medico', function ($Medico) {
           $Medico->on('Agenda.medico','=','Medico.codigo');
        }) -> join('Users as UsersMedico', function ($Users) {
           $Users->on('Medico.codigo','=','UsersMedico.id');
        })
        ->select([ 
           'Agenda.id as id',
           'UsersPaciente.name as paciente',
           'Agenda.data as data',
           'Agenda.horario as horario', 
           'Medico.especialidade',
        ])
        -> where ('UsersMedico.email', '=', Auth::user()->email);
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('data')
            ->addColumn('paciente')
            ->addColumn('especialidade')
            ->addColumn('horario');

    }

    public function columns(): array
    {
        return [
            Column::make('Data', 'data'),
            Column::make('Paciente', 'paciente'),
            Column::make('Especialidade', 'especialidade'),
            Column::make('Horario', 'horario')
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
