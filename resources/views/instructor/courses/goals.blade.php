<x-instructor-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Curso: {{$course->title}}
        </h2>
    </x-slot>

    <x-container class="py-8">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
            <aside class="col-span-1">
                <nav>
                    @include('instructor.courses.includes.menu-table')
                </nav>
            </aside>

            <div class="col-span-1 lg:col-span-4">
                <div class="card">
                    @livewire('instructor.courses.goals', ['course' => $course])
                </div>
            </div>
        </div>
    </x-container>
</x-instructor-layout>