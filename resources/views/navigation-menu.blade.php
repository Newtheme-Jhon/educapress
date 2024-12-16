@php
    $links = [
        [
            'name' => 'Home',
            'route' => '/',
            'active' => request()->routeIs('welcome')
        ],
        [
            'name' => 'Cursos',
            'route' => route('courses.index'),
            'active' => request()->routeIs('courses.*')
        ],
        [
            'name' => 'Categorias',
            'route' => '#',
            'active' => request()->routeIs('categories.*')
        ],
        [
            'name' => 'Blog',
            'route' => route('posts.index'),
            'active' => request()->routeIs('posts.*')
        ],
    ];

    $categories = \App\Models\Category::all();
@endphp

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="/">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                    @foreach ($links as $link)

                        @if ($link['name'] == 'Categorias')
                            <x-nav-link href="{{$link['route']}}" :active="$link['active']" @click="open= !open">
                                {{ $link['name'] }}
                            </x-nav-link>

                            <!--modal categories-->
                            <div class="bg-white absolute mt-[70px] rounded-md shadow-md" style="margin-left:160px; z-index:100;" x-show="open" x-cloak>
                                
                                    @foreach ($categories as $category)
                                        
                                        <div class="hover:bg-gray-100">
                                            <a class="text-gray-700 flex w-full text-sm py-2 pl-5 pr-6 {{$loop->last ? 'pb-4' : 'pb-0'}} cursor-pointer" href="{{route('categories.show', $category)}}">
                                                <div class="pb-2">
                                                    {{$category->name}}
                                                </div>
                                            </a>
                                        </div>
                                        <hr class="opacity-20">
                                    @endforeach
                                
                            </div>

                        @else
                            <x-nav-link href="{{$link['route']}}" :active="$link['active']">
                                {{ $link['name'] }}
                            </x-nav-link>
                        @endif

                    @endforeach
                   
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!--cart item modal-->
                <div x-data="{
                        count: {{ Cart::instance('shopping')->count() }},
                        cart: {{Cart::instance('shopping')->content()}}
                    }" 
                    x-on:cart-updated.window="count = $event.detail" 
                    x-on:item-cart.window="cart = $event.detail[0]"
                    class="relative">

                    @livewire('modal-cart')

                </div>

                <!-- Settings Dropdown -->
                <div class="ms-3 relative">
                    @auth
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                    </button>
                                @else
                                    <span class="inline-flex rounded-md">
                                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                            {{ Auth::user()->name }}

                                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </span>
                                @endif
                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Account') }}
                                </div>

                                <x-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                @can('Crear cursos')
                                    <x-dropdown-link href="{{ route('instructor.home') }}">
                                        {{ __('Instructor') }}
                                    </x-dropdown-link>
                                @endcan

                                @can('admin.home')
                                    <x-dropdown-link href="{{ route('admin.dashboard') }}">
                                        {{ __('Dashboard') }}
                                    </x-dropdown-link>
                                @endcan

                                <x-dropdown-link href="{{ route('courses.myCourses') }}">
                                    Mis cursos
                                </x-dropdown-link>
                               
                                <div class="border-t border-gray-200"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-dropdown-link href="{{ route('logout') }}"
                                            @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    @else
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="text-gray-600">
                                    <i class="fa-regular fa-circle-user text-2xl"></i>
                                </button>
                            </x-slot>

                            <x-slot name="content">

                                <x-dropdown-link href="{{ route('login') }}">
                                    Iniciar sesión
                                </x-dropdown-link>

                                @can('Crear cursos')
                                    <x-dropdown-link href="{{ route('instructor.home') }}">
                                        Instructor
                                    </x-dropdown-link>
                                @endcan

                                @can('admin.home')
                                    <x-dropdown-link href="{{ route('admin.dashboard') }}">
                                        Dashboard
                                    </x-dropdown-link>
                                @endcan

                                <div class="border-t border-gray-200"></div>
                                
                                <x-dropdown-link href="{{ route('register') }}">
                                    Registrarse
                                </x-dropdown-link>
                               
                            </x-slot>
                        </x-dropdown>
                    @endauth
                </div>

            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">

            @foreach ($links as $link)
                <x-responsive-nav-link href="{{ $link['route'] }}" :active="$link['active']">
                    {{ $link['name'] }}
                </x-responsive-nav-link>
            @endforeach

            <x-responsive-nav-link href="{{ route('login') }}">
                Iniciar sesión
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('register') }}">
                Registrarse
            </x-responsive-nav-link>

        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">

                
                    <div class="flex items-center px-4">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <div class="shrink-0 me-3">
                                <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </div>
                        @endif

                        <div>
                            <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                


                <div class="mt-3 space-y-1">
                    <!-- Account Management -->
                    <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link href="{{ route('instructor.home') }}" :active="request()->routeIs('instructor.home')">
                        {{ __('Instructor') }}
                    </x-responsive-nav-link>
                    @can('admin.home')
                        <x-responsive-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('instructor.home')">
                            {{ __('Dashboard') }}
                        </x-responsive-nav-link>
                    @endcan
                    
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <x-responsive-nav-link href="{{ route('logout') }}"
                                    @click.prevent="$root.submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>

                </div>
                

            </div>
        @endauth


    </div>
</nav>
