<?php

namespace App\Livewire\Admin;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\PostCategory;

class PostCategoryTable extends DataTableComponent
{
    protected $model = PostCategory::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),

            Column::make("Title", "title")
                ->sortable()
                ->searchable(),

            Column::make("Slug", "slug")
                ->sortable(),

            Column::make("Fecha", "created_at")
                ->sortable()
                ->format(
                    function($value){
                        return $value->format('d/m/Y');
                    }
                ),

            Column::make("Acciones", "id")
                ->sortable()
                ->format(
                    function($value){
                        return view('admin.posts.tables.category-actions', ['id' => $value]);
                    }
                )

        ];
    }
}
