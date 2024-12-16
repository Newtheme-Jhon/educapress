<?php

namespace App\Livewire\Payments;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StripePayment extends Component
{

    protected $user;

    public function mount()
    {
        if(Auth::check()){
            $this->user = User::find(Auth::user()->id);
            //dd($this->user);
        }
    }


    public function render()
    {
        return view('livewire.payments.stripe-payment');
    }
}
