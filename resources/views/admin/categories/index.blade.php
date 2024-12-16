<x-admin-layout :breadcrumb="[
    [
        'name' => 'Categorias',
        'url' => '#'
    ], 
    [
        'name' => 'Lista de categorias',
    ]
]">

<div class="flex">
    <div class="flex-1">
        <h1 class="mb-3 text-2xl font-semibold">Lista de categorias</h1>
    </div>
    <div>
        <a href="{{route('admin.categories.create')}}" class="btn btn-blue">Crear categoria</a>
    </div>
</div>

@if (session('success'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        <span class="font-medium">
            {{session('success')}}
        </span>
    </div>
@endif


<!--mostrar categorias-->
<div class="mt-4">
    @livewire('admin.categories-table')
</div>

</x-admin-layout>