<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        //si clico en el nombre de la columna, se ordena por ese campo
        $this->setSingleSortingDisabled();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),

            Column::make("Nombre", "name")
                ->sortable()
                ->searchable(),

            Column::make("Email", "email")
                ->sortable()
                ->searchable(),

            Column::make("Rol", "id")
            ->sortable()
            ->format(function($user){

                //return $user->getRoleNames()->first();
                $user = User::find($user);
                if($user->hasRole('admin')){
                    return 'Administrador';
                }elseif($user->hasRole('instructor')){
                    return 'Instructor';
                }else{

                    if($user->getRoleNames()){
                        return $user->getRoleNames()->first();
                    }else{
                        return 'Sin rol';
                    }
                    //return $user->getRoleNames()->first();
                }

            }),

            Column::make("Posición", "sort")
                ->sortable(),

            Column::make("Fecha", "created_at")
                ->sortable()
                ->format(fn($value) => $value->format('d/m/Y')),

            column::make('Acciones', 'id')->sortable()->format(function($value) {
                return view('admin.users.tables.actions', ['id' => $value]);
            })

        ];
    }

}
