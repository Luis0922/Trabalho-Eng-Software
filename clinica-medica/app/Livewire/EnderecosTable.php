<?php

namespace App\Livewire;

use App\Models\BaseEnderecos;
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

final class EnderecosTable extends PowerGridComponent
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
        return BaseEnderecos::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('cep')
            ->addColumn('logradouro')
            ->addColumn('bairro')
            ->addColumn('cidade')
            ->addColumn('estado ');

    }

    public function columns(): array
    {
        return [
            Column::make('CEP', 'cep'),
            Column::make('Logradouro', 'logradouro'),
            Column::make('Bairro', 'bairro'),
            Column::make('Cidade', 'cidade'),
            Column::make('Estado', 'estado')
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
}
