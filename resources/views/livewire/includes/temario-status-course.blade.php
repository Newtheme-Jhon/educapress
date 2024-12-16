<div class="bg-white rounded-lg shadow-lg ">
    <div class="bg-indigo-400 flex justify-center rounded-t-lg py-8">
        <h3 class="text-lg font-semibold text-white px-4 text-center">
            {{$course->title}}
        </h3>
    </div>
    <div class="flex px-6 pt-6 items-center">
        <div class="img pr-6">
            <figure class="rounded-full">
                <img 
                class="w-16 rounded-full" 
                src="{{$course->teacher->profile_photo_url}}" alt="{{'Profesor ' . $course->teacher->name}}">
            </figure>
        </div>
        <div>
            <p class="font-semibold">Profesor</p>
            <p>{{$course->teacher->name}}</p>
        </div>
    </div>
    <div class="px-6 pt-6 pb-12">
        <h3 class="font-semibold text-2xl">Temario del curso</h3>
        <p class="mb-4">
            <span class="font-semibold">Duración:</span> {{$totalTime}}
        </p>

        <!--
            progress bar: https://www.creative-tim.com/learning-lab/tailwind-starter-kit/documentation/css/progressbars
        -->
        <div>
            <div class="relative pt-1">
                <p class="text-xl font-semibold mb-2">
                    <span>Completado</span>
                    <span>{{$this->advanced}}%</span>
                    {{-- @dump($this->advanced) --}}
                </p>
                <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-indigo-200">
                  <div style="width:{{$this->advanced}}%" class="transition-all duration-500 shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-indigo-500"></div>
                </div>
              </div>
        </div>
        {{-- {{$open}} --}}
        <ul class="space-y-3">
            @php
                $counter = 1;
            @endphp
            @foreach ($course->sections as $section)

                
                <li class="mb-4" wire:key="section-{{$section->id}}" x-data="{open: false}">

                    <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-gray-500 text-white">
                        <span class="font-semibold">Sección {{$counter}}:</span>
                    </span>

                    <button x-on:click="open = !open" class="flex justify-start bg-gray-200 shadow-lg w-full font-semibold text-md text-gray-600 px-4 py-2">
                        {{Str::limit($section->name, '60')}}
                    </button>

                    <!--lessons-->
                    <div class="p-4 rounded-b-lg shadow-lg mb-4 -mt-1" x-show="open" x-cloak>
                        <ul class="space-y-2">
                            @foreach ($section->lessons as $key => $lesson)
                                <li x-data="{
                                        currentLesson: {{$current->id}},
                                        lesson: {{$lesson->id}}
                                    }" 
                                    x-init="
                                    function init(){

                                        {{-- console.log(open) --}}
                                        if(this.lesson == this.currentLesson){
                                            open = true
                                        }
                                    }
                                    " 
                                    >
                                    <a wire:click="changeLesson({{$lesson}})" class="flex items-center cursor-pointer">

                                        @if ($lesson->lessonCompleted)
                                            <div class="w-8 border-2 flex justify-center px-2 py-2 rounded-full">
                                                <i class="fa-solid fa-circle-play text-indigo-500"></i>
                                            </div>
                                        @else
                                            @if ($current->id == $lesson->id)
                                                <div class="flex items-center">
                                                    <div class="spinner border-b-2 border-indigo-500 rounded-full h-7 w-7 animate-spin"></div>
                                                </div>
                                            @else
                                                <div class="w-8 border-2 flex justify-center px-2 py-2 rounded-full">
                                                    <i class="fa-solid fa-circle-play text-gray-400"></i>
                                                </div>
                                            @endif
                                            
                                        @endif
                                        
                                        <span class="text-gray-500 hover:font-semibold hover:text-gray-700 px-2 items-center">
                                            <span class="font-semibold">
                                                Lección 
                                                @foreach ($course->lessons->pluck('id') as $key => $number)
                                                    @if ($number == $lesson->id)
                                                        {{$key}}
                                                    @endif
                                                @endforeach
                                            </span>
                                            : {{$lesson->name}} 
                                        
                                        </span>

                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </li>
                @php
                    $counter++
                @endphp
            @endforeach
        </ul>
    </div>
</div>