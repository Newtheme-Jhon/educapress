<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => '#'
    ], 
    [
        'name' => 'Proyects',
    ]
]">

<div class="grid grid-cols-2 gap-6">

    <!--users card-->
    <div class="col-span-1 card bg-gray-100">
        <div class="header flex items-center">
            <div class="flex-1">
                <figure>
                    <img 
                    src="https://img.freepik.com/foto-gratis/avatar-androgino-persona-queer-no-binaria_23-2151100221.jpg?t=st=1727529720~exp=1727533320~hmac=31549614a95b8c510ec45e75b3065a680ca514d17e10f260a7c9ff0f9b70f592&w=740" 
                    alt="" 
                    class="w-24 rounded-full ">
                </figure>
            </div>
            <div>
                <span class="font-semibold text-lg">
                    Total usuarios: {{$users->count()}}
                </span>
            </div>
        </div>

        <div class="body mt-4">
            @livewire('admin.line-chart-user')
        </div>
    </div>

    <!--roles card-->
    <div class="col-span-1 card bg-gray-100">
        <div class="header flex items-center">
            <span>
                <i class="fa-solid fa-address-card text-[32px] text-indigo-500"></i>
            </span>
            <span class="text-lg pl-3 font-semibold">
                Total de roles por usuario
            </span>
        </div>
        <div class="card mt-2 mb-2">
            <div class="flex">
                <div>
                    <i class="fa-solid fa-address-card text-1xl pr-2"></i>
                    <span>
                        ADMIN: 1
                    </span>
                </div>
            </div>
        </div>
        <div class="card mb-2">
            <div class="flex">
                <div>
                    <i class="fa-solid fa-user-graduate text-1xl pr-2"></i>
                    <span>STUDENT: 45</span>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="flex">
                <div>
                    <i class="fa-solid fa-user text-1xl pr-2"></i>
                    <span>TEACHER: 2</span>
                </div>
            </div>
        </div>
    </div>
</div>

</x-admin-layout>