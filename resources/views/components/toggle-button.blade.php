<button wire:ignore class="flex items-center"
    x-data="{
        active: @entangle($attributes->wire('model')).live,
    }" x-on:click="active = !active">

    <i class="fas text-2xl" 
    :class="{
        'fa-toggle-on text-indigo-500': active,
        'fa-toggle-off': !active
    }"></i>

    <span class="text-sm px-2">{{$slot}}</span>

</button>