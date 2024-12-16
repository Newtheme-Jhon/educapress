        
<div x-data="{open:false}">

    <!--arrow button-->
    <div x-on:click="open = !open"
        class="h-6 w-12 -ml-4 bg-indigo-50 hover:bg-indigo-200 flex items-center justify-center cursor-pointer"
        style="clip-path: polygon(75% 0%, 100% 50%, 75% 100%, 0% 100%, 0 51%, 0% 0%);">

        <i class="-ml-2 text-sm fas fa-plus transition duration-300"
            :class="{
                'transform rotate-45': open,
                'transform rotate-0': !open
            }"></i>
    </div>

    <!--Crear nueva sección-->
    <div x-show="open" x-cloak class="mt-6">
        <form wire:submit="store">
            <div class="bg-gray-100 rounded-lg shadow-lg p-6">
                <x-label id="storeSection">Nueva sección</x-label>
                <x-input id="nameSectionCreate" wire:model="name" class="w-full" placeholder="ingrese el nombre de la sección"></x-input>
                <x-input-error for="name"></x-input-error>
                <div class="flex justify-end mt-4">
                    <x-button>Agregar sección</x-button>
                </div>
            </div>
        </form>
    </div>
</div>