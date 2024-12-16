@props(['lesson'])

<div>
    <div 
        wire:ignore 
        x-data="{
            content: @entangle($attributes->wire('model')), //entangle() no interactua bien con esta propiedad
            lessonEditorId: $refs.lessonEditor,
            id: {{$lesson->id}},
            desc: {{\App\Models\Lesson::find($lesson->id)}}
        }" 
        x-init="
            function init(){

                //console.log(this.desc.description)
                const description = this.desc.description;
                @this.dispatch('ckLessonEditor', [this.lessonEditorId, description])

            }
        ">

        <div id="lessonEditor" {{$attributes->wire('model')}} class="w-full" x-ref="lessonEditor"></div>

    </div>
</div>