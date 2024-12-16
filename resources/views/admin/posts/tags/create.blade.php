<x-admin-layout :breadcrumb="[
    [
        'name' => 'Tags',
        'url' => route('admin.tags.index')
    ], 
    [
        'name' => 'crear etiquetas',
    ]
]">


<div class="flex">
    <div class="flex-1">
        <h1 class="mb-3 text-2xl font-semibold">
            Crear Etiqueta
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
    <form action="{{route('admin.tags.store')}}" method="POST">
        @csrf

        <div class="grid grid-cols-6">
            <div class="col-span-6 md:col-span-3">
                <div class="mb-4">
                    <x-label class="font-semibold mb-1">Nombre</x-label>
                    <x-input name="title" id="title" placeholder="Escriba el nombre de la categoria" class="w-full"></x-input>
                    <x-input-error for="title"></x-input-error>
                </div>

                <div class="mb-4">
                    <x-label class="font-semibold mb-1">Slug</x-label>
                    <x-input name="slug" id="slug" class="w-full text-gray-600" readonly></x-input>
                    <x-input-error for="slug"></x-input-error>
                </div>

                <div class="mb-4">
                    <x-button>Crear</x-button>
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