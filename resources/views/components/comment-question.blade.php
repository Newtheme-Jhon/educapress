<div x-data="{
    message: @entangle($attributes->wire('model'))
}" wire:ignore x-init="
    function init(){ 
        @this.dispatch('initializeCKEditor');
        Prism.highlightAll();
    }
">
    <div id="ckEditorQuestions" {{$attributes->wire('model')}} placeholder="Escribe tu comentario"></div>
</div>