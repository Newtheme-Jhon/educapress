<x-app-layout>
    {{-- @dd($client) --}}
    <x-container>
        @livewire('cart-summary', ['cart' => $cart])
    </x-container>

</x-app-layout>