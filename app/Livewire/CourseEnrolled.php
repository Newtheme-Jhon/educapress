<?php

namespace App\Livewire;

use CodersFree\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;

class CourseEnrolled extends Component
{
    public $course;
    public $count;

    /**
     * Con los eventos On se pueden escuchar eventos de otros componentes
     * es decir. si yo en el componente ModalCart elimino un item en el metodo itemRemove() y disparo el evento: item-cart
     * $this->dispatch('item-cart', cart::content());
     * debo de crear en el componente CourseEnrolled un metodo countCart() y dentro de este metodo actualizar el valor de count
     * $this->count = Cart::count();
     * encima de este metodo sera donde estemos a la escucha de lo que ocurra con el evento item-cart  #[On('item-cart')]
     * @param $count
     * @return void
     */

    #[On('item-cart')]
    public function countCart()
    {
        $this->count = Cart::count();
    }

    public function addCart()
    {   
        /**
         * @var \CodersFree\Shoppingcart\Cart $cart
         * los nombres de las llaves del array no se deben modificar
         */
        if(Auth::check()){

            Cart::instance('shopping');
            Cart::add([
                'id' => $this->course->id,
                'name' => $this->course->title,
                'price' => $this->course->price->value,
                'qty' => 1,
                'options' => [
                    'image' => $this->course->image,
                    'slug' => $this->course->slug,
                    'teacher' => $this->course->teacher->name,
                    'course_id' => $this->course->id
                ]
            ]);

            //dd(Cart::content());

            $this->dispatch('cart-updated', Cart::count());
            $this->dispatch('item-cart', cart::content());
            
        }else{
            return redirect()->route('login');
        }
    }

    public function removeCart()
    {
       
        Cart::instance('shopping');
        $item = Cart::content()->where('id', $this->course->id)->first();

        if($item){
            Cart::remove($item->rowId);
        }

        
        //Actualiza la cantidad de elementos en el carrito
        $this->dispatch('cart-updated', Cart::count());
        $this->dispatch('item-cart', cart::content());

    }

    public function buyNow()
    {
        if(Auth::check()){
            $this->addCart();
            return redirect()->route('cart.index');
        }else{
            return redirect()->route('login');
        }
    }

    public function enrolled()
    {
        if(Auth::check()){
            $this->course->students()->attach(Auth::user()->id);
        }

        return redirect()->route('courses.status', $this->course);
    }

    public function render()
    {
        return view('livewire.course-enrolled');
    }
}
