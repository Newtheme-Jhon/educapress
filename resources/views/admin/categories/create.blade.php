<x-admin-layout :breadcrumb="[
    [
        'name' => 'Crear categoria',
        'url' => '#'
    ], 
    [
        'name' => 'Crear nueva categoria',
    ]
]">

<div class="flex">
    <h1 class="mb-3 text-2xl font-semibold">Crear categoria</h1>
</div>

<div class="flex">
    
    <x-card-roles>

        @slot('title')
            Nueva categoria
        @endslot

        <form action="{{route('admin.categories.store')}}" method="post" class="w-full">
            @csrf
        
            <div class="grid grid-cols-1 gap-6">
                <div class="col-span-1">
                    <div class="w-full">
                        <label class="font-semibold">Nombre</label>
                        <x-input name="name" id="name" class="w-full mt-1"></x-input>
                        <x-input-error for="name"></x-input-error>
                    </div>
                
                    <div class="w-full mt-4">
                        <label class="font-semibold">Slug</label>
                        <x-input name="slug" id="slug" class="w-full mt-1" readonly></x-input>
                        <x-input-error for="slug"></x-input-error>
                    </div>

                    <div class="w-full mt-4">
                        <label class="font-semibold">Description</label>
                        <x-textarea name="description" id="description" class="w-full mt-1"/>
                        <x-input-error for="description"></x-input-error>
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