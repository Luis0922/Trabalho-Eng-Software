<?php

namespace App\Livewire;

use App\Models\User;
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

final class UserTable extends PowerGridComponent
{
    use WithExport;

    public function setUp(): array
    {
        return [
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return User::query()->withTrashed();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('name')
            ->addColumn('name_lower', fn (User $model) => strtolower(e($model->name)));
    }

    public function columns(): array
    {
        return [
            Column::make('Name', 'name')
                ->sortable()
                ->searchable()
                ->headerAttribute('text-center'),
            Column::action('Editar Permissão')
                ->headerAttribute('text-center')
        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(\App\Models\User $row): array
    {
        return [
            Button::make('edit', 'Editar')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('permissoes.editar_permissoes', ['user_id' => $row->id]),

        ];
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
