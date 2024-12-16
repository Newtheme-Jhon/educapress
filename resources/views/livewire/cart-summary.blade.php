<div>

    <div class="flex justify-center py-10">
        <h1 class="text-3xl font-semibold">
            Resumen del carrito
        </h1>
    </div>
    <div class="grid grid-cols-3 gap-8">

        <!--items del carrito-->
        <div class="col-span-3 md:col-span-2 ">
            <h1 class="text-2xl font-semibold mb-6">
                Tus cursos
            </h1>
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Curso
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Titulo
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Precio
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Cantidad
                            </th>
                            <th scope="col" class="px-6 py-3">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $item)
                            {{-- @dd($item) --}}
                            
                                <tr wire:key="item-{{$item['id']}}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <a href="{{route('courses.show', $item['id'])}}">
                                            <figure>
                                                <img 
                                                class="w-24 object-cover" 
                                                src="{{$item['options']['image']}}" alt="">
                                            </figure>
                                        </a>
                                    </th>
                                    <td class="px-6 py-4">
                                        <a href="{{route('courses.show', $item['id'])}}" class="hover:text-indigo-400">
                                            {{$item['name']}}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$item['price']}}$
                                        {{-- @dump(number_format($item['price'], 2)) --}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$item['qty']}}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a class="cursor-pointer"
                                        wire:key="itemRemove" 
                                        wire:click="itemRemove({{$item['id']}})">
                                            <i class="fa-solid fa-trash-can text-indigo-500"></i>
                                        </a>
                                    </td>
                                </tr>
                            

                        @endforeach
                    </tbody>
                   
                </table>
            </div>
        </div>

        <!--Total y subtotal-->
        <div class="col-span-3 md:col-span-1 ">
            <h1 class="text-2xl font-semibold mb-6">
                Total del carrito
            </h1>

            <!--table resum shoping-->
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-4">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">

                    <tbody>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Subtotal:
                            </th>
                            <td class="px-6 py-4">
                                {{$subtotal}}$
                            </td>
                        </tr>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                IVA incluido:
                            </th>
                            <td class="px-6 py-4">
                                {{Cart::instance('shopping')->tax('2')}}$
                            </td>
                        </tr>
                        <tr class="bg-white dark:bg-gray-800">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Total:
                            </th>
                            <td class="px-6 py-4">
                                {{$total}}$
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            @if (Cart::instance('shopping')->count() <= 0)
                <div role="alert" class="mt-3 relative flex w-full p-3 text-sm text-white bg-slate-800 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"></path></svg>
                        Debe añadir un elemento al carrito para que aparezcan los métodos de pago.
                    <button class="flex items-center justify-center transition-all w-8 h-8 rounded-md text-white hover:bg-white/10 active:bg-white/10 absolute top-1.5 right-1.5" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            @else

                {{-- paypal payment --}}
                <p class="flex">
                    <div id="paypal-button-container"></div>
                    <p id="result-message"></p>
                </p>

                <!-- Alert Success paypal -->
                <div role="alert" class="mt-3 relative flex w-full p-3 text-sm text-white bg-slate-800 rounded-md" style="display:none" id="paypal-failed">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"></path></svg>
                    El pago no se ha procesado, intentelo de nuevo.
                    <button class="flex items-center justify-center transition-all w-8 h-8 rounded-md text-white hover:bg-white/10 active:bg-white/10 absolute top-1.5 right-1.5" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                {{-- stripe payment --}}
                <div class="grid grid-cols-2 card mt-4">
                    <div class="col-span-2">
                        <figure>
                            <img class="w-full object-cover" src="{{asset('img/pagos-tarjetas2.webp')}}" alt="payments">
                        </figure>
                    </div>
                    <div class="col-span-2">
                        {{-- pagos stripe --}}
                        <form action="cart/stripe/checkout" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <x-button class="w-full mt-3 flex justify-center" type="submit">Pagar Ahora</x-button>
                        </form>
                    </div>
                </div>
                
            @endif
            

            <!--payment 2 stripe-->
            {{-- @livewire('payments.stripe-payment') --}}
        </div>
    </div>
        {{-- @dump($cart) --}}
    </div>

    @push('js')
        <!-- Initialize the JS-SDK -->
        <script
            src="https://www.paypal.com/sdk/js?client-id={{config('services.paypal.client_id')}}&currency=USD&intent=capture">
        </script>

        <script>

            const price = {{$total}};
            // alert(price)

            paypal
            .Buttons({
                style: {
                    shape: "rect",
                    layout: "vertical",
                    color: "gold",
                    label: "paypal",
                },
                createOrder() {
                  return fetch('cart/paypalCreateOrder/' + price)
                    .then((response) => response.text())
                    .then((id) => {
                        return id;
                    })
                },

                onApprove() {
                    return fetch('cart/paypalCompleteOrder', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-Token': '{{csrf_token()}}'
                        }
                    })
                    .then((response) => {

                        console.log(response.status)
                        console.log(response)
                        response.json()
                        if(response.status == 200){
                            const protocolo = window.location.protocol;
                            const nombreHost = window.location.hostname;
                            const route = protocolo + '//' + nombreHost + '/cart/paypal/success';
                            
                            window.location.href = route;
                        }else{
                            document.getElementById('paypal-failed').style.display = 'block';
                        }
                        
                    })

                    .catch((error) =>{
                        console.log(error)
                    })
                },
                onCancel(data){
                    console.log(data)
                },
                onError(error){
                    console.log(error)
                }
            })
            .render("#paypal-button-container"); 
            
        </script>
    @endpush

</div>
