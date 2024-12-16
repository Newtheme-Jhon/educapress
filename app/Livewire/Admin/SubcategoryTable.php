<?php

namespace App\Livewire\Admin;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Subcategory;

class SubcategoryTable extends DataTableComponent
{
    protected $model = Subcategory::class;

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

            Column::make("Category id", "category_id")
                ->sortable(),

            Column::make("Category name", "category.name")
                ->sortable()
                ->searchable(),

            Column::make("Fecha", "created_at")
                ->sortable()
                ->format(function ($value) {
                    return $value->format('d/m/Y');
                }),

            Column::make("Acciones", "id")
                ->sortable()
                ->format(
                    fn ($value) => view('admin.subcategories.tables.actions', ['id' => $value])
                )

        ];
    }
}
