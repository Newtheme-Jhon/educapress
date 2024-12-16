<x-app-layout>

    <!--banner header-->
    <div class="banner mt-1 w-full aspect-[3/1] bg-no-repeat bg-cover bg-center h-[350px] md:h-[450px]" 
        style="background-image: url({{asset('img/img-categorias.webp')}});">
        <x-container class="flex items-center">
            <div class="grid grid-cols-4">
                <div class="col-span-4 md:col-span-3 lg:col-span-2 h-[250px] md:h-[450px] flex items-center">
                    <div class="bg-black opacity-70 py-4 px-4">
                        <p class="text-3xl font-bold text-white">
                            {{$category->name}}
                        </p>
                        <p class="py-6 text-white">

                            @if ($category->description)
                                {{$category->description}}
                            @else
                                Busca los cursos que se adapten a tus nececidades. Entre las categorias encontraras subcategorias, las cuales ayudan a filtrar 
                                mucho mejor lo que estas buscando.
                            @endif

                        </p>
                        {{-- <a href="#" 
                            class="bg-purple-800 py-4 px-8 text-white font-bold uppercase text-xs rounded hover:bg-gray-200 hover:text-gray-800">
                            Contactanos
                        </a> --}}
                    </div>
                </div>
            </div>
        </x-container>
    </div>

    @livewire('category-filter', [
        'category' => $category, 
    ], key($category->id))

</x-app-layout>