<?php

namespace App\Livewire\Admin;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\TeacherPayment;

class TeacherPaymentTable extends DataTableComponent
{
    protected $model = TeacherPayment::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),

            Column::make('PROFESOR', 'teacher.name')
            ->sortable()
            ->searchable(),

            Column::make('PROFESOR_ID', 'user_id')
            ->sortable(),

            Column::make('ID DEL PAGO', 'payment_id')
            ->sortable()
            ->searchable(),
            
            Column::make('Metodo de pago', 'payment_method')
            ->sortable()
            ->searchable(),

            Column::make('CURSO_ID', 'course_id')
            ->sortable(),

            Column::make('TOTAL PAGADO', 'payment_amount')
            ->format(fn ($value) => '$' . number_format($value, 2, '.'))
            ->sortable(),

            Column::make('PAGO PROFESOR', 'payment_teacher')
            ->format(fn ($value) => '$' . number_format($value, 2, '.'))
            ->sortable(),


            Column::make("FECHA DE PAGO", "created_at")
            ->format(fn ($value) => $value->format('d/m/Y'))
            ->sortable(),

        ];
    }
}
