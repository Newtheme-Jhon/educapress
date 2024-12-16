<div class="mb-4" wire:ignore
x-init="
    function init(){
        //console.log(this.data)
        @this.dispatch('initckEditorAnswers')
        
    }
">
    <div id="ckEditorAnswers" {{$attributes->wire('model')}} placeholder="Escribe tu comentario"></div>
</div>