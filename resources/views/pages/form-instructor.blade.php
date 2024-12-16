<x-app-layout>
    <x-container class="mt-4">

        {{-- @dd($status); --}}
        <div class="grid lg:grid-cols-3 gap-8">
            
            @if (session('success'))
                <div class="col-span-2 mt-2 mb-3">
                    <div role="alert" class="mt-3 relative flex w-full p-3 text-sm text-white bg-slate-800 rounded-md">
                        El formulario ha sido enviado correctamente, le responderemos lo antes posible. Gracias
                        <button class="flex items-center justify-center transition-all w-8 h-8 rounded-md text-white hover:bg-white/10 active:bg-white/10 absolute top-1.5 right-1.5" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                </div>
            @endif

            @if ($register_exist > 0)
                @if ($status == 1)
                    <div class="col-span-2 mt-2 mb-3">
                        <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
                            <p class="font-bold">Registro encontrado</p>
                            <p>Se ha enconrado un registro asociado a su cuenta, no se puede enviar otra solicitud.</p>
                        </div>
                    </div>
                @endif
                
            @endif
            
            <div class="col-span-2">
                <div class="card">
                    <h3 class="text-2xl text-center font-semibold">Formulario de solicitud para tutores</h3>
                    <form action="{{route('pages.sendFormInstructor')}}" method="POST">
                        @csrf
                        
                        <div class="mt-4">
                            <p>
                                <b>1. Tema:</b> Cuéntanos un poco sobre qué quieres enseñar, en qué campo. <br>
                            </p>
                            <p class="ml-2 mb-3">
                                <b>Ejemplo 1:</b> Soy desarrollador web y me gustaría dar cursos sobre programación con PHP, JavaScript, etc.
                                <br>
                                <b>Ejemplo 2:</b> Soy profesor de idiomas y me gustaría enseñar inglés y francés.
                            </p>
                            <x-label class="font-semibold mb-1">Tema</x-label>
                            <x-input class="w-full" type="text" name="tema"/>
                            <x-input-error for="tema"></x-input-error>
                        </div>
                        <div class="mt-4">
                            <p>
                                <b>2. Categorías:</b> Ayúdanos a poder identificar fácilmente el área sobre la que desarrollarás tus cursos. <br>
                                Puedes escribir una o dos categorías, las tendremos en cuenta todas.
                            </p>
                            <p class="ml-2 mb-3">
                                <b>Ejemplo 1:</b> Desarrollo web, programación, desarrollo multiplataforma, etc.
                                <br>
                                <b>Ejemplo 2:</b> Idiomas, lengua extranjera, etc.
                            </p>
                            <x-label class="font-semibold mb-1">Categorías</x-label>
                            <x-input class="w-full" type="text" name="categorias"/>
                            <x-input-error for="categorias"></x-input-error>
                        </div>
                        <div class="mt-4">
                            <p>
                                <b>3. Subcategorías:</b> Ayúdanos a poder crear un mejor filtro sobre la categoría en la que trabajarás. <br>
                                Puedes escribir una, dos o más subcategorías, las tendremos en cuenta todas.
                            </p>
                            <p class="ml-2 mb-3">
                                <b>Ejemplo 1:</b> PHP, WordPress, Themes WordPress, Laravel, JavaScript, Angular, VueJS, etc.
                                <br>
                                <b>Ejemplo 2:</b> Inglés, Inglés para negocios, francés, alemán, etc.
                            </p>
                            <x-label class="font-semibold mb-1">Subcategorías</x-label>
                            <x-input class="w-full" type="text" name="subcategorias"/>
                            <x-input-error for="subcategorias"></x-input-error>

                            @if ($register_exist > 0)
                                @if ($status == 1)
                                    <p class="mt-4">
                                        <a class="btn btn-purple cursor-pointer" disabled>Enviar</a>
                                    </p>
                                @endif
                            @endif

                            @if ($register_exist == 0)
                                <x-button class="mt-4">Enviar</x-button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-span-1 border-l-2 pl-4 md:pr-3">
                <div class="card">
                    <div class="header flex">
                        <i class="fas fa-info-circle text-indigo-500 text-lg pr-2"></i>
                        <h3 class="text-xl font-semibold">Información</h3>
                    </div>
                    <div class="body text-gray-500 text-sm mt-2">
                        <p class="pb-2">
                            La información que se pide en este formulario es básica, pero nos permitirá saber 
                            en qué temas trabajarás para la creación de los cursos. 
                            Esto nos ayudará a crear previamente las categorías y subcategorías sobre las que vas a trabajar.
                        </p>
                        <p class="pb-2">
                            Recuerda que esta plataforma está hecha con la intención de poder crear cursos sobre cualquier 
                            tema, ya sea arte, música, diseño, informática, idiomas, negocios, 
                            desarrollo web, fotografía, etc. La imaginación y los límites los pones tú.
                        </p>
                        <p class="pb-2">
                            Recuerda también que estamos trabajando en mejorar la plataforma constantemente 
                            para que no solo puedas generar ingresos con la venta de cursos. 
                            Esta es una plataforma donde se abrirían nuevas oportunidades de negocio 
                            para autores, profesores y emprendedores en el sector educativo.
                        </p>
                        <p class="pb-2">
                            <b>En menos de 24h recibirás una respuesta por correo electrónico, gracias por confiar en nosotros.</b>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </x-container>
</x-app-layout>