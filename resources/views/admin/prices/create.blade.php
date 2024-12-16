<x-admin-layout :breadcrumb="[
    [
        'name' => 'Precios',
        'url' => route('admin.prices.index')
    ], 
    [
        'name' => 'Crear nuevo precio',
    ]
]">

<div class="flex">
    <div class="flex-1">
        <h1 class="mb-3 text-2xl font-semibold">Crear Precio</h1>
    </div>
</div>

<!--form crear nivel-->
<div class="flex">
    
    <x-card-roles>

        @slot('title')
            Nuevo Precio
        @endslot

        <form action="{{route('admin.prices.store')}}" method="post" class="w-full">
            @csrf
        
            <div class="grid grid-cols-1 gap-6">
                <div class="col-span-1">
                    <div class="w-full">
                        <label class="font-semibold">Valor</label>
                        <x-input type="number" name="value" id="value" class="w-full mt-1" step="0.33"></x-input>
                        <x-input-error for="value"></x-input-error>
                    </div>
                </div>
            </div>

            <div class="flex mt-4">
                <x-button>
                    Guardar
                </x-button>
            </div>
        </form>
    </x-card-roles>

</div>


</x-admin-layout>