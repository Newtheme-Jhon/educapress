<div>
    <div>
        <h2 class="font-semibold text-lg mb-1">
            Añadir un recurso
        </h2>
    </div>

    @if ($lesson->resource)

        <div class="flex items-center">
            <div class="flex-1">
                <i wire:click="download({{$lesson->resource->id}})" class="fa-solid fa-cloud-arrow-down text-indigo-600 pr-3 text-lg cursor-pointer"></i>
                {{$lesson->resource->name}}
            </div>
            <div>
                <i wire:click="destroy({{$lesson->resource->id}})" class="fa-solid fa-trash-can text-red-500 text-lg cursor-pointer"></i>
            </div>
        </div>

    @else

        <!--form lesson resource-->
        <div>
            <form wire:submit="save()">
                <div class="flex items-center">
                    <x-input type="file" class="flex-1" wire:model="file"></x-input>
                    <x-button wire:loading.attr="disabled" wire:target="file">Guardar</x-button>
                </div>

                <!--se ha de poner wire: target="file" donde sea que usemos el loading para especificar el archivo 
                    al cual hacemos el loading-->
                <div class="flex items-center" wire:loading wire:target="file">
                    <p class="text-lg text-blue-500 font-semibold">Cargando...</p>
                </div>

                <div class="mt-1">
                    @error('file')
                        <p class="text-red-500 text-xs font-semibold">
                            {{$message}}
                        </p>
                    @enderror
                </div>
            </form>
        </div>

    @endif
</div>
