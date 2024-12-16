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
                    {{-- @dd($course->students[0]->pivot->created_at) --}}
                    <div class="title">
                        <h3 class="font-semibold text-2xl mb-4">
                            Estudiantes inscritos
                        </h3>
                    </div>
                    <div class="table-students relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Nombre
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Fecha de inscripcion
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($course->students as $student)
                
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{$student->name}}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{$student->pivot->created_at->format('d/m/Y')}}
                                        </td>
                                    </tr>
                
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-container>
    
</x-instructor-layout>