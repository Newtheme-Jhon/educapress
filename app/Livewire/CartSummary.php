<?php

namespace App\Livewire;

use CodersFree\Shoppingcart\Facades\Cart;
use Livewire\Attributes\On;
use Livewire\Component;

class CartSummary extends Component
{
    public $cart;
    public $total;
    public $subtotal;

    public function mount($cart)
    {
        //manejo de carrito
        Cart::instance('shopping');

        $this->cart = $cart;

        //manejo de precios
        $this->subtotal = Cart::subtotal() - Cart::tax('2');
        $this->total = Cart::subtotal();
    }

    //Ahora si elimino un item de la pagina cart se elimina al momento 
    //del modal carrito, pero no se elimina de la pagina cartSummary
    //para actualizar la pagina cart sumary debo añadir: $this->cart = Cart::content()->toArray();
    #[On('item-cart')]
    public function itemRemove($course_id)
    {
        Cart::instance('shopping');
        $item = Cart::content()->where('id', $course_id)->first();

        if($item){
            Cart::remove($item->rowId);
        }
        //Actualizo el carrito de la pagina cartSummary

        $this->dispatch('cart-updated', Cart::count());
        $this->dispatch('item-cart', cart::content());

        //debo añadir toArray() porque desde el controller CartController lo estoy pasando asi
        $this->cart = Cart::content()->toArray();

    }

    public function updatedCart()
    {
        $this->emit('cartUpdated', $this->cart);
    }

    public function render()
    {
        return view('livewire.cart-summary');
    }
}
