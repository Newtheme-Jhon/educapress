<div class="mb-4" wire:ignore
x-init="
    function init(){
        //console.log(this.data)
        @this.dispatch('initckEditorAnswersToAnswer')
        
    }
">
    <div id="ckEditorAnswerToAnswer" {{$attributes->wire('model')}} placeholder="Escribe tu comentario"></div>
</div>