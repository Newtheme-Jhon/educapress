<?php

namespace App\Livewire\Instructor;

use App\Models\InstructorPaymentMethod;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class InstructorPaymentMethods extends Component
{
    public $user;
    public $email_payment;
    public $data;

    public function mount()
    {
        $this->user = Auth::user()->id;
        $this->data = InstructorPaymentMethod::where('instructor_id', $this->user)->get();
        //dd($this->data->count());
        if($this->data->count() > 0){
            $this->email_payment = $this->data->first()->email_payment;
        }else{
            $this->email_payment = $this->email_payment;
        }
    }

    public function refresh()
    {
        $this->data = InstructorPaymentMethod::where('instructor_id', $this->user)->get();
    }

    public function paypalSave()
    {
        $this->refresh();
        $this->validate([
            'email_payment' => 'required|email',
        ]);

        if($this->data->count() > 0){
            $this->data->first()->update([
                'email_payment' => $this->email_payment,
            ]);
        }else{
            InstructorPaymentMethod::create([
                'instructor_id' => $this->user,
                'email_payment' => $this->email_payment,
                'payment_method' => 'paypal',
            ]);
        }

        //esto esta en un script de la vista del component
        $this->dispatch('instructor-payment-methods');
    }

    public function render()
    {
        return view('livewire.instructor.instructor-payment-methods');
    }
}
