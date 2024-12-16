<div class="space-y-3">

    {{-- video --}}
    <div>
        @if ($editVideo)
            <div x-data="{
                platform: @entangle('platform')
            }">
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

                <div>
                    <!--Estos dos contenedores se deben de encerrar dentro de un div padre
                    o alpine no renderizara bien y dara error-->
                    <div class="mt-2" x-show="platform == 1" x-cloak>
                        <x-label for="videoplatform1">Video</x-label>
                        <x-progress-indicator wire:model="video" class="mt-2">

                        </x-progress-indicator>
                    </div>

                    <div class="mt-2" x-show="platform == 2" x-cloak>
                        <x-label for="videoplatform2">Video</x-label>
                        <x-input id="urlPlatform2" class="w-full" type="text" wire:model="url" placeholder="Ingrese la url de youtube"></x-input>
                    </div>

                </div>

                <!--cancel button-->
                <div class="flex justify-end space-x-2 mt-3">
                    <x-danger-button wire:click="$set('editVideo', false)">
                        Cancelar
                    </x-danger-button>
                    <x-button wire:click="saveVideo()">
                        Actualizar
                    </x-button>
                </div>

            </div>
        @else

            <div>
                <h2 class="font-semibold text-lg mb-1">
                    Video del curso
                </h2>

                @if ($lesson->is_processed)

                    <div x-data="{open: false}">
                        <div class="md:flex md:items-center mb-2">
                            @if ($lesson->platform == 1)
                                {{-- @dump(Storage::disk('s3')->url($lesson->image_path)) --}}
                                <img src="{{Storage::disk('s3')->url($lesson->image_path)}}" alt="{{$lesson->name}}" 
                                class="w-full md:w-20 aspect-video object-cover object-center img-s3">

                            @else
                                
                                <img src="{{$lesson->image}}" alt="{{$lesson->name}}" 
                                class="w-full md:w-20 aspect-video object-cover object-center img-local">

                            @endif

                
                            <p class="text-sm truncate md:flex-1 md:ml-4">
                                {{$lesson->video_original_name}}
                            </p>
                        </div>

                        <x-button wire:click="$set('editVideo', true)">Remplazar Video</x-button>
                        
                        @if ($lesson->platform == 1)
                            <x-button class="ml-4" x-on:click="open = !open">Ver video</x-button>
                            <div x-show="open" x-cloak>
                                <x-modal-video :lesson="$lesson"></x-modal-video>
                            </div>
                        @endif
                        
                    </div>

                @else
                    <!--datos video-->
                    <div>
                        <table class="table-auto w-full">
                            <thead class="border-b border-gray-200">
                                <tr class="font-bold">
                                    <td class="px-4 py-2">
                                        Nombre del archivo
                                    </td>
                                    <td class="px-4 py-2">
                                        Tipo
                                    </td>
                                    <td class="px-4 py-2">
                                        Estado
                                    </td>
                                    <td class="px-4 py-2">
                                        Fecha
                                    </td>
                                </tr>
                            </thead>
                            <tbody class="border-b border-x-gray-200">
                                <tr>
                                    <td class="px-4 py-2">
                                        {{$lesson->video_original_name}}
                                    </td>
                                    <td class="px-4 py-2">
                                        Video
                                    </td>
                                    <td class="px-4 py-2">
                                        Procesando...
                                    </td>
                                    <td class="px-4 py-2">
                                        {{$lesson->created_at->format('d/m/Y')}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="mt-2">El video se esta procesanso</p>
                    </div>

                @endif

            </div>
            
        @endif
    </div>

    <hr>

    {{-- description video --}}
    <div>
        <h2 class="font-semibold text-lg mb-1">
            Descripción de la lección
        </h2>
        
        @if ($editDescription)
            <form wire:submit="saveDescription()" wire:key="lesson-desc-{{$lesson->id}}">
                <!--lesson description component-->
                
                <x-lesson-description :lesson="$lesson" wire:model="description"></x-lesson-description>

                <div class="flex justify-end mt-4">
                    <x-button>
                        Actualizar
                    </x-button>
                </div>

            </form>
        @else
            <div class="text-gray-600 ckeditor mb-2">
                {!! $lesson->description !!}
                <p class="{{$lesson->description == null ? '' : 'hidden'}}">
                    Aun no se ha escrito una descripción
                </p>
            </div>
            <x-button wire:click="$set('editDescription', true)">Descripción</x-button>
        @endif
    </div>

    <hr>

    <!--añadir recursos a una lección-->
    @livewire('instructor.courses.lesson-resource', 
    ['lesson' => $lesson], 
    key('lesson-resource-' . $lesson->id))

    <hr>

    <div>
        <!--para actualizar los valores de las propiedades en tiempo real
            crearemos un metodo updated() en el modelo del componente-->
       <x-toggle-button wire:model="is_published">Publicado</x-toggle-button>
       <x-toggle-button wire:model="is_preview">Vista previa</x-toggle-button>
    </div>
    <style>

        .ck-editor__editable_inline:not(.ck-comment__input *) {
            height: 200px;
            overflow-y: auto;
        }
        
    </style>
        
    
</div>

