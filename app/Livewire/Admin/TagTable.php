<?php

namespace App\Livewire\Admin;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Tag;

class TagTable extends DataTableComponent
{
    protected $model = Tag::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),

            Column::make("Titulo", "title")
                ->sortable()
                ->searchable(),

            Column::make("Slug", "slug")
                ->sortable(),

            Column::make("Created at", "created_at")
                ->sortable()
                ->format(function ($value) {
                    return $value->format('d/m/Y');
                }),

            Column::make("Acciones", "id")
                ->format(function ($value) {
                    return view('admin.posts.tables.tag-actions', ['id' => $value]);
                })
                ->html(),

        ];
    }
}
