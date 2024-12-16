<x-admin-layout :breadcrumb="[
    [
        'name' => 'Profesores',
        'url' => route('admin.teachers.approved.index')
    ], 
    [
        'name' => 'Mensaje de solicitud',
    ]
]">

<div class="flex">
    <div class="flex-1">
        <h1 class="mb-3 text-2xl font-semibold">Mensaje de Solicitud</h1>
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

    <div class="grid grid-cols-3 gap-8">
        <div class="col-span-2">
            <div class="bg-gray-100 shadow-lg rounded-lg px-3 py-4">
                <p class="pb-3">
                    <span class="font-semibold">Nombre del usuario: </span> <br>
                    <span class="text-gray-600"> {{$request->user_name}} </span>
                </p>
                <p class="pb-3">
                    <span class="font-semibold">Email: </span> <br>
                    <span class="text-gray-600"> {{$request->email}} </span>
                </p>
                <p class="pb-3">
                    <span class="font-semibold">Tema: </span> <br>
                    <span class="text-gray-600"> {{$request->tema}} </span>
                </p>
                <p class="pb-3">
                    <span class="font-semibold">Categorias: </span> <br>
                    <span class="text-gray-600"> {{$request->categorias}} </span>
                </p>
                <p class="pb-3">
                    <span class="font-semibold">Subcategorias: </span> <br>
                    <span class="text-gray-600"> {{$request->subcategorias}} </span>
                </p>
            </div>
        </div>
        <div class="col-span-1">
            <div>
                <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4 mb-4" role="alert">
                    <p class="font-bold">Aprobar tutor</p>
                    <p>Antes de aprobar la solicitud, recuerde que debe dar de alta las categorías, subcategorías y cambiar el rol de estudiante a profesor.</p>
                </div>
            </div>
            <form action="{{route('admin.teachers.approved.emailApproved', $request->id)}}"  method="POST">
                @csrf
                <x-button>Aprobar</x-button>
            </form>
        </div>
    </div>

</div>

</x-admin-layout>