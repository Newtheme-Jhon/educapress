<x-admin-layout :breadcrumb="[
    [
        'name' => 'Categorias',
        'url' => route('admin.post_categories.index')
    ], 
    [
        'name' => 'editar categoria',
    ]
]">


<div class="flex">
    <div class="flex-1">
        <h1 class="mb-3 text-2xl font-semibold">
            Editar Categoria
        </h1>
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
    <form action="{{route('admin.post_categories.update', $post_category)}}" method="POST">
        @csrf
        @method('put')

        <div class="grid grid-cols-6">
            <div class="col-span-6 md:col-span-3">
                <div class="mb-4">
                    <x-label class="font-semibold mb-1">Nombre</x-label>
                    <x-input name="title" id="title" placeholder="Escriba el nombre de la categoria" class="w-full" value="{{$post_category->title}}"></x-input>
                    <x-input-error for="title"></x-input-error>
                </div>

                <div class="mb-4">
                    <x-label class="font-semibold mb-1">Slug</x-label>
                    <x-input name="slug" id="slug" class="w-full text-gray-600" value="{{$post_category->slug}}" readonly></x-input>
                    <x-input-error for="slug"></x-input-error>
                </div>

                <div class="mb-4">
                    <x-button>Actualizar</x-button>
                </div>

            </div>
        </div>
    </form>
</div>

@push('js')

<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/stringToSlug-1.3/jquery.stringToSlug.min.js')}}"></script>

<script>
    $(document).ready( function() {
        $("#title").stringToSlug({
            setEvents: 'keyup keydown blur',
            getPut: '#slug',
            space: '-'
        });
    });
</script>

@endpush

</x-admin-layout>