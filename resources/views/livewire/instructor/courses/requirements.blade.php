<div>

    @if (count($requirements))

        <ul class="space-y-2 mb-4" id="requirements">
            @foreach ($requirements as $index => $requirement)
                <li wire:key="requirement-{{$requirement['id']}}" data-id="{{$requirement['id']}}">
                    <div class="flex">
                        <x-input wire:model="requirements.{{$index}}.name" class="flex-1 rounded-r-none"></x-input>
                        <div class="border border-l-0 border-gray-300">
                            <div class="flex items-center h-full hover:bg-red-500 hover:text-white">
                                <button onclick="requirementDestroy({{ $requirement['id'] }})" class="px-3">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </div>
                        <div class="border border-l-0 border-gray-300 hover:cursor-move rounded-r-md">
                            <div class="flex items-center h-full">
                                <button onclick="requirementDestroy({{ $requirement['id'] }})" class="px-3 hover:cursor-move">
                                    <i class="fa-solid fa-bars"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>

        <div class="flex justify-end mb-8">
            <x-button wire:click="update()">Actualizar</x-button>
        </div>

    @endif


    <form wire:submit="store">
        <div class="bg-gray-100 rounded-lg shadow-lg p-6">
            <x-label>Nuevo requisito</x-label>
            <x-input wire:model="name" class="w-full" placeholder="ingrese el nombre del requisito"></x-input>
            <x-input-error for="name"></x-input-error>
            <div class="flex justify-end mt-4">
                <x-button>Agregar requisito</x-button>
            </div>
        </div>
    </form>

    @push('js')

        <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

        <script>
            const requirements = document.getElementById('requirements');
            const sortable = new Sortable(requirements, {
                animation: 150,
                ghostClass: 'blue-background-class',
                store: {
                    set: function (sortable) {
                        const order = sortable.toArray();
                        //console.log(order);
                        @this.call('sortOrderRequirements', order);
                    }
                }
            })
        </script>

        <script>
            function requirementDestroy(id){
                Swal.fire({
                    title: "Estas seguro?",
                    text: "No podras revertir esta acción!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "si, eliminarlo!",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Eliminado!",
                            text: "La meta ha sido eliminada.",
                            icon: "success"
                        });

                        @this.call('destroy', id);
                    }
                });
            }
        </script>
    @endpush


</div>
