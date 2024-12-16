<div class="mb-4" wire:ignore x-data="{
    data: @entangle($attributes->wire('model')),
}"
x-init="
    function init(){
        //console.log(this.data)
        @this.dispatch('initckAnswerEdit', this.data)
        
    }
">
    <div id="ckAnswerEdit" {{$attributes->wire('model')}} placeholder="Escribe tu comentario"></div>
</div>