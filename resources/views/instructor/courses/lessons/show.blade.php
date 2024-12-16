<div x-data="{
    open: false
}">

    <div class="md:flex md:items-center">
        <!--title h3-->
        <h1 class="md:flex-1 truncate cursor-move handle-lesson">
            <i class="fas fa-play-circle text-indigo-500"></i>
            Lección {{$orderLessons->search($lesson->id) + 1}}: 
            {{$lesson->name}}
        </h1>

        <!--buttons lesson-->
        <div class="space-x-3 md:shrink-0 md:ml-6">
            <button wire:click="edit({{$lesson->id}})">
                <i class="fa-solid fa-pen-to-square hover:text-indigo-600"></i>
            </button>
            <button x-on:click="destroyLesson({{$lesson->id}})">
                <i class="fa-solid fa-trash-can hover:text-red-500"></i>
            </button>
            <button x-on:click="open = !open">
                <i class="fas fa-chevron-down hover:text-blue-500" 
                :class="{
                    'fa-chevron-up': open,
                    'fa-chevron-down': !open
                }"></i>
            </button>
        </div>
    </div>

    <!--cobtenido de la lección x-cloak para quitar el parpadeo-->
    <div x-show="open" x-cloak class="mt-4">
        @livewire('instructor.courses.manage-lesson-content', [
            'lesson' => $lesson
        ], key('section-' . $section->id . '-lesson-' . $lesson->id))
    </div>

</div>