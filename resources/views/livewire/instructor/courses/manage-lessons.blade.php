<div>
    <!--show lessons-->
    <div 
        x-data="{
            destroyLesson(lessonId)
            {
                Swal.fire({
                    title: 'Estas seguro?',
                    text: 'No podras revertir esta acción!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'si, eliminarlo!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Eliminado!',
                            text: 'La lección ha sido eliminada.',
                            icon: 'success'
                        });

                        @this.call('destroy', lessonId);
                    }
                });
            }
        }" 
        x-init="new Sortable($refs.lessons, {
            group: 'lessons',
            animation: 150,
            handle: '.handle-lesson',
            ghostClass: 'blue-background-class',
            store: {
                set: function (sortable) {
                    const order = sortable.toArray();
                    console.log(order);
                    console.log({{$section->id}})

                    /** Almacenaremos los cambios dede el manage-sections class 
                     * Este evento que estamos emitiendo debemos escucharlo en el metodo 
                     * sortLessons() de la clase del componente ManageSections
                     * para ello encima del metodo escribimos: #[On('sortLessons')]
                     * 
                     * **/
                    Livewire.dispatch('sortLessons', {
                        sorts: order,
                        sectionId: {{$section->id}}
                    })
                    
                }
            }
        })"
        class="mb-6">
        <ul class="space-y-4" x-ref="lessons">
            @foreach ($lessons as $lesson)
                <li wire:key="lesson-{{$lesson->id}}" data-id="{{$lesson->id}}">

                    <!--list of lessons-->
                    <div class="bg-white rounded-lg shadow-lg px-6 py-4">
                    
                        @if ($lessonEdit['id'] == $lesson->id)
                            
                            <!--edit lessons-->
                            @include('instructor.courses.lessons.edit')

                        @else
                            
                            <!--list of lessons-->
                            @include('instructor.courses.lessons.show')
          
                        @endif

                    </div>

                </li>
            @endforeach
        </ul>
    </div>

    <!--create lessons-->
    <div x-data="{
            open: @entangle('lessonCreate.open'),
            platform: @entangle('lessonCreate.platform')
        }">

        <!--arrow button-->
        <div x-on:click="open = !open"
            class="h-6 w-12 -ml-4 bg-indigo-200 hover:bg-indigo-300 flex items-center justify-center cursor-pointer"
            style="clip-path: polygon(75% 0%, 100% 50%, 75% 100%, 0% 100%, 0 51%, 0% 0%);">

            <i class="-ml-2 text-sm fas fa-plus transition duration-300"
                :class="{
                    'transform rotate-45': open,
                    'transform rotate-0': !open
                }">
            </i>
        </div>

        <form wire:submit="store()" class="mt-4 bg-white rounded-lg shadow-lg" x-show="open" x-cloak>
            <div class="p-6">
                <div class="mb-2">
                    <x-input id="nameLessonCreate" wire:model="lessonCreate.name" placeholder="Nombre de la lección" class="w-full" />
                    <x-input-error for="lessonCreate.name" />
                </div>

                <!--plataformas-->
                <div>
                    <x-label for="plataformas">Plataformas</x-label>

                    <div class="md:flex md:items-center md:space-x-4">
                        <div class="flex items-center space-x-4">
                            <button type="button" 
                                class="inline-flex flex-col justify-center items-center w-20 h-24 border rounded" 
                                :class="platform == 1 ? 'border-indigo-500 text-indigo-500' : 'border-x-gray-300'" 
                                x-on:click="platform = 1">
                                
                                <i class="fas fa-video text-2xl"></i>
                                <span class="text-sm mt-2">Video</span>
    
                            </button>
    
                            <button type="button" 
                                class="inline-flex flex-col justify-center items-center w-20 h-24 border rounded" 
                                :class="platform == 2 ? 'border-indigo-500 text-indigo-500' : 'border-x-gray-300'" 
                                x-on:click="platform = 2">
                                
                                <i class="fa-brands fa-youtube text-2xl"></i>
                                <span class="text-sm mt-2">Youtube</span>
    
                            </button>
                        </div>
                        <p>
                            Primero debes elegir una plataforma para subir el contenido
                        </p>
                    </div>

                    <div class="mt-2" x-show="platform == 1" x-cloak>
                        <x-label for="video">Video</x-label>
                        <x-progress-indicator wire:model="video">

                        </x-progress-indicator>
                    </div>

                    <div class="mt-2" x-show="platform == 2" x-cloak>
                        <x-label for="video-youtube">Video</x-label>
                        <x-input id="manageLessonUrl" class="w-full" type="text" wire:model="url" placeholder="Ingrese la url de youtube"></x-input>
                    </div>
                </div>
            </div>

            <div class="flex justify-end px-6 py-4 bg-gray-100">
                <x-danger-button x-on:click="open = false">
                    Cancelar
                </x-danger-button>
                <x-button class="ml-2">
                    Guardar
                </x-button>
            </div>
        </form>

    </div>

    @push('js')

        <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

    @endpush

</div>
