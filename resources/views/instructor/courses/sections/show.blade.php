<div class="md:flex md:items-center">
    <h1 class="md:flex-1 truncate handle cursor-move">
        Sección {{$loop->iteration}}: 
        <br class="md:hidden">
        <span class="font-semibold">{{$section->name}}</span>
    </h1>
    <div class="space-x-3 md:shrink-0 md:ml-6">
        <button wire:click="edit({{$section->id}})">
            <i class="fa-solid fa-pen-to-square hover:text-indigo-600"></i>
        </button>
        <button x-on:click="destroySection({{$section->id}})">
            <i class="fa-solid fa-trash-can hover:text-red-500"></i>
        </button>
    </div>
</div>