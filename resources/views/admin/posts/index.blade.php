<x-admin-layout :breadcrumb="[
    [
        'name' => 'Posts',
        'url' => '#'
    ], 
    [
        'name' => 'ver posts',
    ]
]">


<div class="flex">
    <div class="flex-1">
        <h1 class="mb-3 text-2xl font-semibold">Lista de posts</h1>
    </div>
</div>

@if (session('success'))
<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
    <span class="font-medium">
        {{session('success')}}
    </span>
</div>
@endif


<!--mostrar posts-->
<div class="mt-4">
    @livewire('admin.post-table')
</div>


</x-admin-layout>