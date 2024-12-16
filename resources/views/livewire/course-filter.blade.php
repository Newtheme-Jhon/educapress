<div>
    <!--banner header-->
    <div class="banner mt-1 w-full aspect-[3/1] bg-no-repeat bg-cover bg-center h-[350px] md:h-[450px]" 
        style="background-image: url({{asset('img/courses/banner-courses-2.webp')}});">
        <x-container class="flex items-center">
            <div class="grid grid-cols-4">
                <div class="col-span-4 md:col-span-3 lg:col-span-2 h-[250px] md:h-[450px] flex items-center">
                    <div class="bg-black opacity-70 py-4 px-4">
                        <p class="text-3xl font-bold text-white">Cursos online para cualquier profesión</p>
                        <p class="py-6 text-white">
                        Nuestra misión es democratizar la educación en cualquier ámbito profesional, haciéndola 
                        accesible a cualquier persona, independientemente de su formación o experiencia previa. 
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

    {{-- @json($selectedCategories) --}}
    <x-container class="mt-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <aside class="col-span-1">
                @include('livewire.includes.filters-courses')
            </aside>
            <div class="col-span-3">
                <div>
                    <x-input class="w-full mb-2" placeholder="Buscar curso" wire:model.live="search"></x-input>
                </div>

                <div class="grid gap-4 xl:grid-cols-2  md:grid-cols-2">
                    @foreach ($courses as $course)
                        {{-- @dd($course) --}}
                        <x-card-courses :course="$course" wire:key="course-{{$course->id}}"></x-card-courses>
                    @endforeach
                </div>

                 <!--paginate-->
                <div class="mt-4">
                    {{$courses->links()}}
                </div>
            </div>
        </div>
    </x-container>
</div>
