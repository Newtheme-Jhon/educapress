<div 
    x-data="{
        open: false, 
    }">

    <x-button x-on:click="open = !open">Escribe tu reseña</x-button>


    <div x-show="open">
        <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <!--
            Background backdrop, show/hide based on modal state.
        
            Entering: "ease-out duration-300"
                From: "opacity-0"
                To: "opacity-100"
            Leaving: "ease-in duration-200"
                From: "opacity-100"
                To: "opacity-0"
            -->
            
        
            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" x-on:click="open = !open" aria-hidden="true"></div>

                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

                    <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
     
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0">
                            <h3 class="text-2xl font-semibold leading-6 text-gray-900" id="modal-title">¡Tu opinion importa!</h3>
                            <div class="mt-4">
                            <p class="text-1xl text-gray-500">
                                Comparte tu experiencia y contibuye para seguir creando contenido de calidad
                            </p>
                            <div class="flex justify-center mt-3 space-x-2 text-2xl">
                                <label class="cursor-pointer">
                                    <i class="fa-solid fa-star {{$rating >= 1 ? 'text-indigo-400' : 'text-gray-500'}} relative"></i>
                                    <x-input name="rating" class="absolute top-0 left-0 opacity-0" type="radio" id="star5" wire:model.live="rating" value="1"/>
                                </label>
                                <label class="cursor-pointer">
                                    <i class="fa-solid fa-star {{$rating >= 2 ? 'text-indigo-400' : 'text-gray-500'}} relative"></i>
                                    <x-input name="rating" class="absolute top-0 left-0 opacity-0" type="radio" id="star5" wire:model.live="rating" value="2"/>
                                </label>
                                <label class="cursor-pointer">
                                    <i class="fa-solid fa-star {{$rating >= 3 ? 'text-indigo-400' : 'text-gray-500'}} relative"></i>
                                    <x-input name="rating" class="absolute top-0 left-0 opacity-0" type="radio" id="star5" wire:model.live="rating" value="3"/>
                                </label>
                                <label class="cursor-pointer">
                                    <i class="fa-solid fa-star {{$rating >= 4 ? 'text-indigo-400' : 'text-gray-500'}} relative"></i>
                                    <x-input name="rating" class="absolute top-0 left-0 opacity-0" type="radio" id="star5" wire:model.live="rating" value="4"/>
                                </label>
                                <label class="cursor-pointer">
                                    <i class="fa-solid fa-star {{$rating == 5 ? 'text-indigo-400' : 'text-gray-500'}} relative"></i>
                                    <x-input name="rating" class="absolute top-0 left-0 opacity-0" type="radio" id="star5" wire:model.live="rating" value="5"/>
                                </label>
                            </div>

                            <p class="text-red-600 text-sm font-semibold">
                                {{$errorReview}}
                            </p>

                            <div class="flex mt-4">
                                <x-textarea class="w-full" rows="3" wire:model="comment"></x-textarea>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button class="btn btn-blue" wire:click="save()"> Guardar </button>
                    </div>
                    {{-- @dump($course) --}}
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

@push('js')

@endpush
