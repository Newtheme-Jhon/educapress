<x-app-layout>
    <x-container class="mt-6">
        <div class="flex justify-center">
            <h1 class="text-3xl font-semibold underline mb-4">
                Mis cursos
            </h1>
           
        </div>
        <div class="flex justify-center">
            {{-- @dump($courses->count()) --}}
            @if ($courses->count() <= 0)
                <div>
                    <p class="mt-4">Aun no esta matriculado en ningun curso</p>
                    <p class="flex justify-center mt-3">
                        <a class="btn btn-yellow" href="{{route('courses.index')}}">Ver cursos</a>
                    </p>
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-8 mt-6 justify-items-center">
            @foreach ($courses as $course)
                <div class="col-span-1">
                    <x-card-my-course :course="$course"></x-card-my-course>
                </div>
            @endforeach
        </div>
        <div class="mt-4">
            {{$courses->links()}}
        </div>
    </x-container>
</x-app-layout>