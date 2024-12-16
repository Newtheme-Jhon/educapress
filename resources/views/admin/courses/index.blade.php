<x-admin-layout :breadcrumb="[
    [
        'name' => 'Courses',
        'url' => '#'
    ], 
    [
        'name' => 'ver cursos',
    ]
]">


<div class="flex">
    <div class="flex-1">
        <h1 class="mb-3 text-2xl font-semibold">Lista de cursos</h1>
    </div>
</div>

@if (session('success'))
<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
    <span class="font-medium">
        {{session('success')}}
    </span>
</div>
@endif


<!--mostrar roles-->
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Nombre del curso
                </th>
                <th scope="col" class="px-6 py-3">
                    Categoria
                </th>
                <th scope="col" class="px-6 py-3">
                    Acción
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $course)

                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$course->id}}
                    </th>
                    <td class="px-6 py-4">
                        {{$course->title}}
                    </td>
                    <td class="px-6 py-4">
                        {{$course->category->name}}
                    </td>
                    <td class="px-6 py-4 flex space-x-2">
                        <a href="{{route('admin.courses.show', $course)}}" class="btn btn-green">Revisar</a>
                    </td>
                </tr>

            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{$courses->links()}}
</div>



</x-admin-layout>