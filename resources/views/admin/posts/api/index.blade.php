<x-admin-layout :breadcrumb="[
    [
        'name' => 'Posts',
        'url' => route('admin.posts.index')
    ], 
    [
        'name' => 'api posts',
    ]
]">


<div class="flex">
    <div class="flex-1">
        <h1 class="mb-3 text-2xl font-semibold">Recuperar pots</h1>
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
    <h3 class="mb-6">
        Botón para recuperar posts
    </h3>
    <a class="btn btn-purple" href="{{route('admin.api.posts.get')}}">Recuperar</a>
</div>


</x-admin-layout>