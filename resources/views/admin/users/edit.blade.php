<x-admin-layout :breadcrumb="[
    [
        'name' => 'Users',
        'url' => '#'
    ], 
    [
        'name' => 'ver usuarios',
    ]
]">

@if (session('success'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        <span class="font-medium">
            {{session('success')}}
        </span>
    </div>
@endif

<div class="flex">
    <div class="flex-1">
        <h1 class="mb-3 text-2xl font-semibold">Editar usuario</h1>
    </div>
</div>

<div class="flex bg-gray-100 rounded-t-lg p-4 items-center">
    <div class="pr-6">
        <figure>
            <img 
            src="https://img.freepik.com/foto-gratis/avatar-androgino-persona-queer-no-binaria_23-2151100221.jpg?t=st=1727529720~exp=1727533320~hmac=31549614a95b8c510ec45e75b3065a680ca514d17e10f260a7c9ff0f9b70f592&w=740" 
            class="w-24 h-auto rounded-full" alt="">
        </figure>
    </div>
    <div>
        <h3 class="font-semibold text-2xl">Usuario: {{$user->name}}</h3>
    </div>
</div>
<div class="card">
    <form action="{{route('admin.users.update', $user)}}" method="POST" class="w-full">
        @csrf
        @method('put')
    
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="col-span-1">
                <div class="w-full">
                    <h3 class="font-semibold text-2xl mb-4">Datos del usuario</h3>
                    <label for="name" class="font-semibold">Nombre</label>
                    <x-input name="name" value="{{$user->name}}" class="w-full mt-1"></x-input>
                </div>
            
                <div class="w-full mt-4">
                    <label for="name" class="font-semibold">Rol</label>
                    <x-select name="roles" class="w-full">
                        @foreach ($roles as $role)
                            @if ($role->name == $role_user)
                                <option value="{{$role->name}}" selected> {{$role->name}} </option>
                            @else
                                <option value="{{$role->name}}"> {{$role->name}} </option>
                            @endif
                            
                        @endforeach
                        
                    </x-select>
                </div>
            </div>
            <div class="col-span-1">
                <div class="w-full">
                    <h3 class="font-semibold text-2xl mb-4">Permisos del usuario</h3>
                    <ul class="grid grid-cols-2">
                        @foreach ($permissions as $permission)
                            <li>
                                <div>
                                    <label for="">
                                        @if (in_array($permission->id, $permissionsAssigned))
                                            <x-checkbox name="permissions[]" value="{{$permission->name}}" :checked="true"></x-checkbox>
                                            {{$permission->name}}
                                        @else
                                            <x-checkbox name="permissions[]" value="{{$permission->name}}"></x-checkbox>
                                            {{$permission->name}}
                                        @endif
                             
                                    </label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="flex mt-4 md:justify-end">
            <x-button>Actualizar</x-button>
        </div>
    </form>
</div>

</x-admin-layout>

