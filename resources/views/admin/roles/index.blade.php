<x-admin-layout :breadcrumb="[
    [
        'name' => 'Roles',
        'url' => '#'
    ], 
    [
        'name' => 'ver roles',
    ]
]">


<div class="flex">
    <div class="flex-1">
        <h1 class="mb-3 text-2xl font-semibold">Lista de Roles</h1>
    </div>
    <div>
        <a href="{{route('admin.roles.create')}}" class="btn btn-blue">Crear Rol</a>
    </div>
</div>

{{-- @dd($roles->count()) --}}
@if ($roles->count() == 0)
    <p>Aun no existen roles</p>
@else

    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <span class="font-medium">
                {{session('success')}}
            </span>
        </div>
    @endif

    @if (session('delete'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <span class="font-medium">
                {{session('delete')}}
            </span>
        </div>
    @elseif (session('error'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <span class="font-medium">
                {{session('error')}}
            </span>
        </div>

    @endif

    <!--mostrar roles-->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        <i class="fa-solid fa-id-card"></i>
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nombre del rol
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fecha de creación
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)

                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$role->id}}
                        </th>
                        <td class="px-6 py-4">
                            {{$role->name}}
                        </td>
                        <td class="px-6 py-4">
                            {{$role->created_at->format('d/m/Y')}}
                        </td>
                        <td class="px-6 py-4 flex space-x-2" x-data="
                        {
                            page: 'roles',
                            sweetalert(){
                                let page = this.page;
                                let item = 'rol';
                                let form = $refs.formDeleteRol;
                                //console.log(form)

                                //esta función esta en: resources/assets/js/
                                alertConfirmation(form, page, item)
                            }
                        }
                        ">
                            <a href="{{route('admin.roles.edit', $role)}}" class="btn btn-green">Editar</a>

                            <form x-ref="formDeleteRol" action="{{route('admin.roles.destroy', $role)}}" method="POST" style="display:none">
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

@endif

@push('js')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!--función para eliminar registro-->
    <script src="{{asset('vendor/functionsjs/admin-ajax-delete.js')}}"></script>

@endpush

</x-admin-layout>