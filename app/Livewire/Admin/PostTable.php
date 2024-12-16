<?php

namespace App\Livewire\Admin;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class PostTable extends DataTableComponent
{
    protected $model = Post::class;

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

            Column::make("Categoria", "post_category_id")
                ->sortable(),

            Column::make("Estatus", "status")
            ->sortable(),

            Column::make("Usuario", "user.name")
                ->sortable()
                ->searchable(),

            Column::make("Publicado", "created_at")
                ->sortable()
                ->format(
                    fn ($value, $row) => $row->created_at->format('d/m/Y')
                ),

            column::make('Acciones', 'id')->sortable()->format(function($value) {
                return view('admin.posts.tables.actions', ['id' => $value]);
            })

        ];
    }

        public function builder(): Builder
        {   
            $user = User::find(Auth::user()->id);
            $user->hasRole('writer');
            if ($user->hasRole('admin')) {
                return Post::latest()->with('user');
            }else{
                return Post::where('user_id', Auth::user()->id)->with('user');
            }
            
        }
}
