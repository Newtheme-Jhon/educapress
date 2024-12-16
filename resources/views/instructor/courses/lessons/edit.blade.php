<form wire:submit="update()">
    <div class="flex items-center space-x-2">
        <x-label for="leccion">
            Lección: 
        </x-label>

        <x-input id="lessonname" wire:model="lessonEdit.name" class="flex-1"></x-input>
    </div>

    <div class="flex justify-end mt-4">
        <div class="space-x-2">
            <!--$set() accion magica livewire: cambia el valor de una propiedad-->
            <!--si cambia id a null se cerrara el input de editar-->
            <x-danger-button wire:click="$set('lessonEdit.id', null)">
                Cancelar
            </x-danger-button>
            <x-button class="button">
                Actualizar
            </x-button>
        </div>
    </div>
</form>