<x-app-layout>
    <x-container class="py-8">
        {{-- @dd($course) --}}
        <div class="grid gap-4 md:grid-cols-1">

            <!-- component banner-->
            <div class="text-gray-700 py-10 lg:py-28 px-10 bg-stone-200">
                <div class="grid gap-4 grid-cols-1 lg:grid-cols-2">

                    {{-- column 1 --}}
                    <div class="text-course order-2 lg:order-1">
                        <p class="text-4xl md:text-3xl lg:text-4xl font-bold mt-4 lg:mt-0">{{$course->title}}</p>
                        <p class="py-6">
                        Nuestra misión es democratizar la educación en inteligencia artificial, haciéndola 
                        accesible a cualquier persona, independientemente de su formación o experiencia previa. 
                        </p>

                        {{-- bullets --}}
                        <div class="bullets">
                            <span class="text-violet-500 pr-2"><i class="fas fa-signal"></i></span><span class="pr-3">{{$course->level->name}}</span>
                            <span class="text-violet-500 pr-2"><i class="fas fa-clock"></i></span><span class="pr-3">3 Horas</span>
                            <span class="text-violet-500 pr-2"><i class="fas fa-star"></i></span><span class="pr-3"> 4.5</span>
                        </div>

                        {{-- button --}}
                        <div class="mt-[60px]">
                            <div class="flex">
                                @if ($course->price->value == 0)
                                    <span class="text-xl sm:text-2xl md:text-4xl font-bold pr-4">Gratis</span>
                                    <span>
                                        <a href="#" class="text-md md:text-lg lg:text-1xl bg-purple-800 py-2 md:py-4 px-4 md:px-8 text-white font-bold uppercase rounded hover:bg-violet-400 hover:text-withe">
                                            Inscribirse
                                        </a>
                                    </span>
                                @else
                                    <span class="text-xl sm:text-2xl md:text-4xl font-bold pr-4">USD {{number_format($course->price->value, 2)}}</span>
                                    <span>
                                        <a href="#" class="text-md md:text-lg lg:text-1xl bg-purple-800 py-2 md:py-4 px-4 md:px-8 text-white font-bold uppercase rounded hover:bg-violet-400 hover:text-withe">
                                            Comprar  
                                        </a>
                                    </span>
                                @endif
                                
                            </div>
                        </div>
                    </div>  

                    {{-- column 2 --}}
                    <div class="image-course rounded-md order-1">
                        @if ($course->image)
                            <img class="w-full" src="{{$course->image}}" alt="Sunset in the mountains"> 
                        @else
                            <img class="w-full" 
                            src="https://img.freepik.com/vector-premium/vector-icono-imagen-predeterminado-pagina-imagen-faltante-diseno-sitio-web-o-aplicacion-movil-no-hay-foto-disponible_87543-11093.jpg" 
                            alt="Sunset in the mountains"> 
                        @endif
                        
                    </div>

                </div>
            </div>
        </div>

        {{-- contenido lo que aprendere --}}
        @include('courses.includes.contenido')
        
    </x-container>

    <!--description-->
    <div class="bg-stone-200">
        <x-container class="py-8">
            <h2 class="text-3xl font-semibold pb-4">
                Descripción del curso
            </h2>
            <div class="pb-6 pt-3">
                @if ($course->description)
                    {!! $course->description !!}
                @else
                    <p>No hay descripción</p>
                @endif
            </div>
        </x-container>
    </div>

    <!--curriculum-->
    <div>
        <x-container class="py-8">
            <h2 class="text-3xl font-semibold pb-4">
                Temario del curso
            </h2>
            <div class="pb-6 pt-3 grid grid-cols-3 gap-6">

                <!--sections-->
                <div class="col-span-3 lg:col-span-2">
                    @include('courses.includes.temario-show-course')
                </div>

                <!--detalles del curso-->
                <div class="col-span-3 lg:col-span-1">
                    <div class="p-4 bg-white rounded-lg shadow-lg">
                        <div class="flex justify-center py-4">
                            <h2 class="text-xl font-semibold">Detalle del curso</h2>
                        </div>

                        <!--descriptions-->
                        <div>
                            <p>
                                <span><i class="fa-solid fa-calendar text-indigo-600 inline-block w-6"></i></span>
                                <span class="font-semibold">Ultima actualización: </span> {{$course->created_at->format('d/m/Y')}}
                            </p>
                            <p>
                                <span><i class="fa-solid fa-clock text-indigo-600 inline-block w-6"></i></span>
                                <span class="font-semibold">Duración: </span> 3 horas
                            </p>
                            <p>
                                <span><i class="fas fa-signal text-indigo-600 inline-block w-6"></i></span>
                                <span class="font-semibold">Nivel: </span> {{$course->level->name}} 
                            </p>
                            <p>
                                <span><i class="fas fa-star text-indigo-600 inline-block w-6"></i></span>
                                <span class="font-semibold">Calificación: </span> 5
                            </p>
                            <p>
                                <span class="font-semibold">Acceso de por vida</span>
                            </p>
                        </div>

                        <!--buttons-->
                        @can('enrolled', $course)
                            <div class="block sm:flex mb-4 mt-4 justify-end lg:justify-start space-y-4 sm:space-y-0 space-x-0 sm:space-x-4">
                                <span>
                                    <a href="{{route('courses.status', $course)}}" 
                                        class="flex justify-center sm:block w-full text-md px-3 py-3
                                        bg-gray-800 border border-transparent rounded-md font-semibold text-xs 
                                        text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 
                                        active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 
                                        focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">
                                        Empezar el curso
                                    </a>
                                </span>
                            </div>
                                <p>
                                    <spn>icon</spn>
                                    <span>Adquirido el: </span>
                                    <spn> {{$course->dateOfEnrollment}} </spn>
                                </p>
                            <div>
                                
                            </div>
                        @else
                            @livewire('course-enrolled', ['course' => $course], key($course->id))
                        @endcan
                        
                    </div>

                    <!--button aprobe course-->
                    <div class="flex mt-4">
                        <form action="{{route('admin.courses.approve', $course)}}" method="POST">
                            @csrf
                            <x-button>Aprobar curso</x-button>
                        </form>
                    </div>
                    <div class="flex mt-4 uppercase text-sm">
                        <a href="{{route('admin.courses.observation', $course)}}" class="btn btn-red">Observaciones</a>
                    </div>

                </div>

               

            </div>
        </x-container>
    </div>
</x-app-layout>