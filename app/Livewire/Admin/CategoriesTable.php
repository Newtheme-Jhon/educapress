<?php

namespace App\Livewire\Admin;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Category;

class CategoriesTable extends DataTableComponent
{
    protected $model = Category::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),

            Column::make("Nombre", "name")
                ->sortable()
                ->searchable(),

            Column::make("Slug", "slug")
                ->sortable(),

            Column::make("Fecha", "created_at")
                ->sortable()
                ->format(
                    fn($value, $row) => $row->created_at->format('d/m/Y')
                ),

            column::make('Acciones', 'id')->sortable()->format(function($value) {
                return view('admin.categories.tables.actions', ['id' => $value]);
            })
           
        ];
    }
}
