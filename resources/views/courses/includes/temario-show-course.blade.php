<ul class="space-y-4">
    @forelse ($course->sections as $section)
        <li x-data="{open: false}">
            <div class="bg-white rounded-lg shadow-lg">
                <button x-on:click="open = !open" class="flex w-full p-4 bg-stone-200 text-left border-bottom">
                    <span class="text-lg font-semibold"> {{$section->name}} </span>
                    <span class="ml-auto">
                        {{$section->lessons->count()}}
                    </span>
                </button>
                <div x-show="open" class="p-4" x-cloak>
                    <ul class="space-y-2">
                        @foreach ($section->lessons as $lesson)
                            <li>
                                <a href="{{route('courses.status', $course, $lesson->slug)}}" class="flex items-center">
                                    <i class="fa-solid fa-circle-play text-indigo-500"></i>
                                    <span class="text-gray-600 hover:font-semibold hover:text-gray-900 px-2">
                                        {{$lesson->name}}
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </li>
    @empty
        <li>Este curso no tiene secciones</li>
    @endforelse
</ul>