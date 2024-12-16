@props(['cart' => $cart])

<div 
    x-data="{
        open: false, 
        route: `{{route('cart.index')}}`,
        redirect(){
            this.open = false;
            window.location.href = this.route
        }
    }">

    <a class="cursor-pointer" x-on:click="open = !open">
        <i class="fa-solid fa-cart-shopping text-lg text-gray-600"></i>
        <span 
            x-show="count" 
            x-text="count" 
            class="absolute -top-2 -right-3 inline-flex items-center justify-center px-2 py-1 text-xs font-bold text-white bg-indigo-500 rounded-full">

        </span>
    </a>

    <div x-show="open">
        <div class="modal-cart relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <!--
            Background backdrop, show/hide based on modal state.
        
            Entering: "ease-out duration-300"
                From: "opacity-0"
                To: "opacity-100"
            Leaving: "ease-in duration-200"
                From: "opacity-100"
                To: "opacity-0"
            -->
            
        
            <div class="modal-screen fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="modal-screen-color fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" x-on:click="open = !open" aria-hidden="true"></div>

                <div class="flex  items-end justify-end text-center sm:items-center sm:p-0">
                    <!--
                    Modal panel, show/hide based on modal state.
            
                    Entering: "ease-out duration-300"
                        From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        To: "opacity-100 translate-y-0 sm:scale-100"
                    Leaving: "ease-in duration-200"
                        From: "opacity-100 translate-y-0 sm:scale-100"
                        To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    -->
                    <div class="modal-component relative transform overflow-hidden bg-white text-left shadow-xl transition-all sm:my-0 sm:w-full sm:max-w-lg">
                        <div class="modal-header flex items-center bg-gray-100 px-4 py-4">
                            <div class="flex-1">
                                <h3 class="text-2xl font-semibold leading-6 text-gray-900" id="modal-title">Resumen del carrito</h3>
                            </div>
                            <div>
                                <i x-on:click="open = !open" class="fa-solid fa-circle-xmark text-3xl text-indigo-500 pr-4 cursor-pointer"></i>
                            </div>
                        </div>
                        <div class="bg-white px-4 pb-4 sm:p-6 sm:pb-4">

                            <div class="">
                                <div class="mt-3 sm:ml-4 sm:mt-0">
            
                                    <div>
                                        <p class="text-1xl text-gray-500">
                                            
                                            @foreach ($cart as $item)

                                                
                                                <div class="card w-full mb-4">
                                                    <div class="grid grid-cols-6 gap-6">
                                                        <div class="col-span-2">
                                                            <figure>
                                                                <img 
                                                                class="w-full object-cover"
                                                                src="{{$item->options->image}}" alt="">
                                                            </figure>
                                                        </div>
                                                        <div class="col-span-4">
                                                            <p class="text-sm font-semibold">{{$item->name}}</p>
                                                            <p class="text-sm"><span class="font-semibold">Cantidad:</span> {{$item->qty}}</p>
                                                            <p class="text-sm"><span class="font-semibold">Precio:</span> {{$item->price}}$</p>
                                                            <p class="flex justify-end">
                                                                <a class="cursor-pointer" href="">
                                                                    <i class="fa-solid fa-trash-can text-indigo-500"></i>
                                                                </a>
                                                            </p>
                                                        </div>
                                                        
                                                    </div>
                                                </div>

                                            @endforeach
                                        </p>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 flex sm:px-6">
                            <div class="flex-1">
                                <p>Subtotal:</p>
                            </div>
                            <div>
                                {{-- {{$item->price}} --}}
                          
                            </div>
                        </div>

                        <!--buttons-->
                        <div class="bg-white px-4 py-3 grid grid-cols-2 gap-6 items-center">
                            <div class="col-span-1">
                                <a x-on:click="redirect()" class="btn btn-blue inline-block w-full text-center cursor-pointer"> Ver carrito </a>
                            </div>
                            <div class="col-span-1">
                                <a class="btn btn-blue inline-block w-full text-center cursor-pointer"> Checkout </a>
                            </div>
                        </div>
         
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
