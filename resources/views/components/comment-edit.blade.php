<div class="mb-4" wire:ignore x-data="{
    data: @entangle($attributes->wire('model')),
}"
x-init="
    function init(){
        //console.log(this.data)
        @this.dispatch('initckEdit', this.data)
        
    }
">
    <div id="ckedit" {{$attributes->wire('model')}} placeholder="Escribe tu comentario"></div>
</div>