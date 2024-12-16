<x-admin-layout :breadcrumb="[
    [
        'name' => 'Roles',
        'url' => '#',
    ], 
    [
        'name' => 'Crear roles',
    ]
]">

<div class="flex">
    <h1 class="mb-3 text-2xl font-semibold">Crear roles</h1>
</div>

<div class="flex">
    
    <x-card-roles>

        @slot('title')
            Nuevo Rol
        @endslot
        <form action="{{route('admin.roles.store')}}" method="post" class="w-full">
            @csrf
        
            <div>
                <x-label class="w-full font-semibold mb-1">Nombre</x-label>
                <x-input name="name" class="w-full"></x-input>
                <x-input-error for="name"></x-input-error>
            </div>
            <div>
                <h3 class="font-semibold mt-4 mb-2">Añadir permisos</h3>
                <ul class="grid grid-cols-2">
                    @foreach ($permissions as $permission)
                        <li class="w-full">
                          <div>
                                <label>
                                    <x-input type="checkbox" name="permissions[]" value="{{$permission->name}}"></x-input>
                                    {{$permission->name}}
                                </label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="flex justify-end mt-3">
                <x-button>
                    Guardar
                </x-button>
            </div>
        </form>
    </x-card-roles>

</div>



</x-admin-layout>