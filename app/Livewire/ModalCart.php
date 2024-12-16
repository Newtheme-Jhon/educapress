<?php
namespace App\Livewire;

use CodersFree\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalCart extends Component
{
    public $items;
    public $subtotal;

    public function mount()
    {
        Cart::instance('shopping');
        $cart = Cart::content();
        foreach ($cart as $item) {
            $this->items[] = [
                'rowId' => $item->rowId,
                'course_id' => $item->id,
                'name' => $item->name,
                'price' => $item->price,
                'qty' => $item->qty,
                'image' => $item->options->image,
                'slug' => $item->options->slug,
                'teacher' => $item->options->teacher
            ];
        }

        $this->items = collect($this->items);
        $this->dispatch('item-cart', Cart::count());

    }

    //Actualiza el subtotal del carrito
    #[On('item-cart')]
    public function updateSubtotal()
    {
        $this->subtotal = Cart::instance('shopping')->subtotal();
    }

    public function itemRemove($course_id)
    {
        Cart::instance('shopping');
        $item = Cart::content()->where('id', $course_id)->first();

        if($item){
            Cart::remove($item->rowId);
        }

        //Actualiza la cantidad de elementos en el carrito
        $this->dispatch('cart-updated', Cart::count());
        $this->dispatch('item-cart', cart::content());

    }

    public function render()
    {
        return view('livewire.modal-cart');
    }
}
