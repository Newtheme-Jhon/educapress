<x-admin-layout :breadcrumb="[
    [
        'name' => 'Users',
        'url' => '#'
    ], 
    [
        'name' => 'ver usuarios',
    ]
]">


<div class="flex">
    <div class="flex-1">
        <h1 class="mb-3 text-2xl font-semibold">Lista de usuarios</h1>
    </div>
    <div>
        <a href="{{route('admin.users.create')}}" class="btn btn-blue">Crear Usuario</a>
    </div>
</div>

<!--mostrar roles-->
<div class="mt-4">
    @livewire('user-table')
</div>


</x-admin-layout>