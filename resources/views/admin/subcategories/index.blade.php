<x-admin-layout :breadcrumb="[
    [
        'name' => 'Subcategorias',
        'url' => route('admin.subcategories.index')
    ], 
    [
        'name' => 'Lista de subcategorias',
    ]
]">

<div class="flex">
    <div class="flex-1">
        <h1 class="mb-3 text-2xl font-semibold">Lista de subcategorias</h1>
    </div>
    <div>
        <a href="{{route('admin.subcategories.create')}}" class="btn btn-blue">Crear subcategoria</a>
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
    @livewire('admin.subcategory-table')
</div>

</x-admin-layout>