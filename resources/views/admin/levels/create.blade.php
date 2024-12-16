<x-admin-layout :breadcrumb="[
    [
        'name' => 'Niveles',
        'url' => route('admin.levels.index')
    ], 
    [
        'name' => 'Crear nuevo nivel',
    ]
]">

<div class="flex">
    <div class="flex-1">
        <h1 class="mb-3 text-2xl font-semibold">Crear Niveles</h1>
    </div>
</div>

<!--form crear nivel-->
<div class="flex">
    
    <x-card-roles>

        @slot('title')
            Nuevo Nivel
        @endslot

        <form action="{{route('admin.levels.store')}}" method="post" class="w-full">
            @csrf
        
            <div class="grid grid-cols-1 gap-6">
                <div class="col-span-1">
                    <div class="w-full">
                        <label class="font-semibold">Nombre</label>
                        <x-input name="name" id="name" class="w-full mt-1" placeholder="Ecriba el nombre del Nivel"></x-input>
                        <x-input-error for="name"></x-input-error>
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