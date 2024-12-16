<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\On;

class LineChartUser extends Component
{
    public $users;
    public $meses;
    public $usersData = [];

    public function mount()
    {
        $this->users = User::all();
        $this->meses = $this->meses();
        $this->getUsersData();
        //dd($this->meses);
    }

    public function meses()
    {
        Carbon::setLocale('es_ES'); // Establecemos el idioma español

        $this->meses = collect();

        for ($i = 1; $i <= 12; $i++) {
            $this->meses->push(Carbon::create(now()->year, $i, 1)->format('M'));
        }
        
        return $this->meses;
    }

    public function getUsersData()
    {
        $this->usersData = $this->users->map(function ($user) {
            $data = [];
            for ($i = 1; $i <= 12; $i++) {
                $data[] = $user->whereMonth('created_at', $i)->count();
            }
            return [
                'name' => $user->name,
                'data' => $data,
            ];
        });
    }

    public function render()
    {
        return view('livewire.admin.line-chart-user');
    }
}
