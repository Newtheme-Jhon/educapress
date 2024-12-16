<x-admin-layout :breadcrumb="[
    [
        'name' => 'Subcategorias',
        'url' => route('admin.subcategories.index')
    ], 
    [
        'name' => 'Crear nueva subcategoria',
    ]
]">

<div class="flex">
    <h1 class="mb-3 text-2xl font-semibold">Crear subcategoria</h1>
</div>

<div class="grid grid-cols-2">
    <div class="col-span-1 card">
        <form action="{{route('admin.subcategories.store')}}" method="POST">
            @csrf

            <div>
                {{-- @dd($categories) --}}
                <x-label class="w-full font-semibold mb-1">Categorias</x-label>
                <x-select name="category_id" class="w-full">
                    <option value="">Selecciona una categoria</option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </x-select>
                <x-input-error for="category_id"></x-input-error>
            </div>
            <div class="mt-3">
                <x-label class="w-full font-semibold mb-1">Nombre</x-label>
                <x-input class="w-full" name="name" id="name" placeholder="Nombre de la subcategoria"></x-input>
                <x-input-error for="name"></x-input-error>
            </div>
            <div class="mt-3">
                <x-label class="w-full font-semibold mb-1">Slug</x-label>
                <x-input class="w-full text-gray-600" name="slug" id="slug" placeholder="Nombre de la subcategoria" readonly></x-input>
            </div>
            <div class="flex mt-4">
                <x-button>
                    Guardar
                </x-button>
            </div>

        </form>
    </div>
</div>

@push('js')

<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>

<script src="{{asset('vendor/stringToSlug-1.3/jquery.stringToSlug.min.js')}}"></script>

<script>
    $(document).ready(function(){
        $('#name').stringToSlug({
            setEvents: 'keyup keydown blur',
            getPut: '#slug',
            space: '-'
        })
    })
</script>

@endpush

</x-admin-layout>