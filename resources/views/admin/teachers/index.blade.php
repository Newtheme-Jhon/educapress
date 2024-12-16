<x-admin-layout :breadcrumb="[
    [
        'name' => 'Profesores',
        'url' => route('admin.teachers.approved.index')
    ], 
    [
        'name' => 'Lista de subcategorias',
    ]
]">

<div class="flex">
    <div class="flex-1">
        <h1 class="mb-3 text-2xl font-semibold">Lista de solicitudes para tutores</h1>
    </div>
</div>

@if (session('success'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        <span class="font-medium">
            {{session('success')}}
        </span>
    </div>
@endif


<!--mostrar categorias-->
<div class="mt-4">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        <i class="fa-solid fa-id-card"></i>
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fecha
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requests as $item)

                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$item->user_id}}
                        </th>
                        <td class="px-6 py-4">
                            {{\App\Models\User::find($item->user_id)->name}}
                        </td>
                        <td class="px-6 py-4">
                            {{$item->email}}
                        </td>
                        <td class="px-6 py-4">
                            @switch($item->status)
                                @case(0)
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">EN_PROCESO</span>
                                    @break
                                @case(1)
                                    <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">APROBADO</span>
                                    @break
                                @case(2)
                                    <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">RECHAZADO</span>
                                    @break
                                @default
                                    
                            @endswitch
                        </td>
                        <td class="px-6 py-4">
                            {{$item->fecha}}
                        </td>
                        <td class="px-6 py-4 flex space-x-2" x-data="
                        {
                            page: 'teachers/approved',
                            sweetalert(){
                                let page = this.page;
                                let item = 'registro';
                                let form = $refs.formDeleteRegistro;
                                //console.log(form)

                                //esta función esta en: resources/assets/js/
                                alertConfirmation(form, page, item)
                            }
                        }
                        ">
                            <a href="{{route('admin.teachers.approved.show', $item->id)}}" class="btn btn-green">VER</a>

                            <form x-ref="formDeleteRegistro" action="{{route('admin.teachers.approved.destroy', $item->id)}}" method="POST" style="display:none">
                                @csrf
                                @method('DELETE')
                                
                            </form>
                            <button class="btn btn-red" x-ref="buttonDeleteRol" x-on:click="sweetalert()">Eliminar</button>
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>

@push('js')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!--función para eliminar registro-->
    <script src="{{asset('vendor/functionsjs/admin-ajax-delete.js')}}"></script>

@endpush

</x-admin-layout>