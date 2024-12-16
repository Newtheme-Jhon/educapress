<x-admin-layout :breadcrumb="[
    [
        'name' => 'Editar categoria',
        'url' => '#'
    ], 
    [
        'name' => 'Editar',
    ]
]">

@if (session('success'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        <span class="font-medium">
            {{session('success')}}
        </span>
    </div>
@endif


<div class="flex">
    <div class="flex-1">
        <h1 class="mb-3 text-2xl font-semibold">Editar Categoria</h1>
    </div>
</div>

<div class="flex bg-gray-100 rounded-t-lg p-4 items-center">
    <div class="pr-6">
        <figure>
            <img 
            src="https://img.freepik.com/foto-gratis/avatar-androgino-persona-queer-no-binaria_23-2151100221.jpg?t=st=1727529720~exp=1727533320~hmac=31549614a95b8c510ec45e75b3065a680ca514d17e10f260a7c9ff0f9b70f592&w=740" 
            class="w-24 h-auto rounded-full" alt="">
        </figure>
    </div>
    <div>
        <h3 class="font-semibold text-2xl"> {{$category->name}} </h3>
    </div>
</div>
<div class="card">
    <form action="{{route('admin.categories.update', $category)}}" method="POST" class="w-full">
        @csrf
        @method('PUT')
    
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="col-span-1">
                <div class="w-full">
                    <label class="font-semibold">Nombre</label>
                    <x-input name="name" id="name" value="{{$category->name}}" class="w-full mt-1"></x-input>
                    <x-input-error for="name"></x-input-error>
                </div>
            
                <div class="w-full mt-4">
                    <label class="font-semibold">Slug</label>
                    <x-input name="slug" id="slug" value="{{$category->slug}}" class="w-full mt-1" readonly></x-input>
                    <x-input-error for="slug"></x-input-error>
                </div>

                <div class="w-full mt-4">
                    <label class="font-semibold">Description</label>
                    <x-textarea name="description" id="description" class="w-full mt-1">{{$category->description}}</x-textarea>
                    <x-input-error for="description"></x-input-error>
                </div>
            </div>
        </div>
        <div class="flex mt-4">
            <x-button>Guardar</x-button>
        </div>
    </form>
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


