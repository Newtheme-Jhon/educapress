<div>
    <x-container>

        <div class="grid grid-cols-3 gap-8 mt-6">
            <div class="col-span-3 md:col-span-2">
                <h3 class="font-semibold text-2xl text-center">Métodos de pago</h3>
                <div class="card mt-4">
                    <form wire:submit="paypalSave()">
                        <div class="border-2 bg-gray-50 rounded-lg shadow-lg">
                            <div class="grid grid-cols-4 gap-6 p-4">
                                <div class="col-span-4 md:col-span-1">
                                    <figure>
                                        <img src="{{asset('img/instructor/logo-paypal.webp')}}" class="w-32" alt="paypal">
                                    </figure>
                                </div>
                                <div class="col-span-4 md:col-span-3">
                                    <x-input class="w-full" placeholder="Correo electrónico" wire:model="email_payment"/>
                                    <x-input-error for="email_payment"></x-input-error>
                                </div>
                                <div class="col-span-4 flex justify-end">
                                    <div>
                                        <x-button>Guardar</x-button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-span-3 md:col-span-1 mt-8">
                <div class="col-span-2 mb-3">
                    <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
                        <p class="font-bold">Métodos de pago</p>
                        <p>
                            Es muy importante que añadas la cuenta de correo electrónico de PayPal 
                            para poder hacer el pago. Los pagos se realizarán cada mes.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </x-container>
@push('js')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('livewire:init', () => {
           Livewire.on('instructor-payment-methods', (event) => {
                Swal.fire({
                    title: "Buen trabajo",
                    text: "¡has añadido tu correo de PayPal!",
                    icon: "success"
                });
           });
        });
    </script>

@endpush
</div>
