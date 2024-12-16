<div x-data="{
    count: {{ Cart::instance('shopping')->count() }},
    
}" 
x-on:item-remove.window="count = $event.detail[0]"
>

    <div class="block sm:flex mb-4 mt-4 justify-end lg:justify-start space-y-4 sm:space-y-0 space-x-0 sm:space-x-4">
        @if ($course->price->value == 0)

        <!--button inscribirse-->
            <div>
                <span>
                    <a href="#" 
                        wire:click="enrolled" 
                        class="flex justify-center sm:block w-full text-md text-sm bg-purple-800 py-2 px-4 text-white font-bold uppercase rounded hover:bg-violet-400 hover:text-withe">
                        Inscribete ahora
                    </a>
                </span>
            </div>

        @else

            @if (Cart::instance('shopping')->content()->where('id', $course->id)->first())
                <div>
                    <span>
                        <a href="{{route('cart.index')}}" 
                            wire:click="buyNow" 
                            class="flex justify-center sm:block w-full text-md text-sm bg-purple-800 py-2 px-4 text-white font-bold uppercase rounded hover:bg-violet-400 hover:text-withe">
                            Comprar
                        </a>
                    </span>
                </div>
                <div>
                    <span>
                        <a href="#" 
                            wire:key="removeCart" 
                            wire:click="removeCart()" 
                            class="flex justify-center sm:block w-full text-md text-sm bg-red-500 py-2 px-4 text-white font-bold uppercase rounded hover:bg-red-300 hover:text-withe">
                            Eliminar carrito
                        </a>
                    </span>
                </div>
            @else

                <div>
                    <span>
                        <a 
                            wire:click="buyNow" 
                            class="flex justify-center cursor-pointer sm:block w-full text-md text-sm bg-purple-800 py-2 px-4 text-white font-bold uppercase rounded hover:bg-violet-400 hover:text-withe">
                            Comprar
                        </a>
                    </span>
                </div>
                <div>
                    <span>
                        <a href="#" 
                            wire:key="addCart" 
                            wire:click="addCart" 
                            class="flex justify-center sm:block w-full text-md text-sm bg-purple-800 py-2 px-4 text-white font-bold uppercase rounded hover:bg-violet-400 hover:text-withe">
                            Añadir carrito
                        </a>
                    </span>
                </div>
            
            @endif

        @endif
      
    </div>
</div>
