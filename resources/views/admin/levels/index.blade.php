<x-admin-layout :breadcrumb="[
    [
        'name' => 'Niveles',
        'url' => route('admin.levels.index')
    ], 
    [
        'name' => 'Lista de Niveles',
    ]
]">

<div class="flex">
    <div class="flex-1">
        <h1 class="mb-3 text-2xl font-semibold">Lista de Niveles</h1>
    </div>
    <div>
        <a href="{{route('admin.levels.create')}}" class="btn btn-blue">Crear Nivel</a>
    </div>
</div>

@if (session('success'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        <span class="font-medium">
            {{session('success')}}
        </span>
    </div>
@endif

    <!--mostrar niveles-->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        <i class="fa-solid fa-id-card"></i>
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nombre del nivel
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fecha de creación
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($levels as $level)

                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$level->id}}
                        </th>
                        <td class="px-6 py-4">
                            {{$level->name}}
                        </td>
                        <td class="px-6 py-4">
                            {{$level->created_at->format('d/m/Y')}}
                        </td>
                        <td class="px-6 py-4 flex space-x-2" x-data="{
                            page: 'levels', 
                            sweetalert(){
                                let page = this.page;
                                let item = 'nivel';
                                let form = $refs.formDeleteLevel;
                                alertConfirmation(form, page, item)

                            }
                        }">
                            <a href="{{route('admin.levels.edit', $level)}}" class="btn btn-green">Editar</a>

                            <form x-ref="formDeleteLevel" class="hidden" action="{{route('admin.levels.destroy', $level)}}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button x-on:click="sweetalert()" class="btn btn-red">Eliminar</button>
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{asset('vendor/functionsjs/admin-ajax-delete.js')}}"></script>
    @endpush

</x-admin-layout>