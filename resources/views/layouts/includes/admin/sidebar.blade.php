@php

   $links = [
      [
         'name' => 'Dashboard',
         'icon' => 'fa-solid fa-gauge admin-icon-style',
         'route' => route('admin.dashboard'),
         'active' => request()->routeIs('admin.dashboard')
      ],

      [
         'header' => 'Administrar Usuarios'
      ],

      [
         'name' => 'Users',
         'icon' => 'fa-solid fa-users admin-icon-style',
         'active' => request()->routeIs('admin.users.*'),
         'submenu' => [
            [
               'name' => 'Ver Usuarios',
               'icon' => 'fa-solid fa-eye admin-icon-style',
               'route' => route('admin.users.index'),
               'active' => request()->routeIs('admin.users.index')
            ],
            // [
            //    'name' => 'Crear Usuarios',
            //    'icon' => 'fa-solid fa-user-plus admin-icon-style',
            //    'route' => route('admin.users.create'),
            //    'active' => request()->routeIs('admin.users.create')
            // ],
         ]
      ],

      [
         'name' => 'Roles',
         'icon' => 'fa-solid fa-id-card admin-icon-style',
         'active' => request()->routeIs('admin.roles.*'),
         'submenu' => [
            [
               'name' => 'Lista de roles',
               'icon' => 'fas fa-list admin-icon-style',
               'route' => route('admin.roles.index'),
               'active' => request()->routeIs('admin.roles.index')
            ],
            [
               'name' => 'Crear Roles',
               'icon' => 'fa-solid fa-user-plus admin-icon-style',
               'route' => route('admin.roles.create'),
               'active' => request()->routeIs('admin.roles.create')
            ],

         ]
      ],

      [
         'header' => 'Administrar Solicitudes'
      ],

      [
         'name' => 'Solicitudes para profesores',
         'icon' => 'fas fa-chalkboard-teacher admin-icon-style',
         'active' => request()->routeIs('admin.teachers.*'),
         'submenu' => [
            [
               'name' => 'Lista de Solicitudes',
               'icon' => 'fas fa-graduation-cap admin-icon-style',
               'route' => route('admin.teachers.approved.index'),
               'active' => request()->routeIs('admin.teachers.approved.index')
            ],

         ]
      ],

      [
         'header' => 'Administrar Cursos'
      ],

      [
         'name' => 'Cursos',
         'icon' => 'fas fa-school admin-icon-style',
         'active' => request()->routeIs('admin.courses.*'),
         'submenu' => [
            [
               'name' => 'Pendientes de revisión',
               'icon' => 'fa-solid fa-eye admin-icon-style',
               'route' => route('admin.courses.index'),
               'active' => request()->routeIs('admin.courses.index')
            ],

         ]
      ],

      [
         'name' => 'Categorias',
         'icon' => 'fas fa-folder admin-icon-style',
         'active' => request()->routeIs('admin.categories.*'),
         'submenu' => [
            [
               'name' => 'Lista de categorias',
               'icon' => 'fas fa-folder-open admin-icon-style',
               'route' => route('admin.categories.index'),
               'active' => request()->routeIs('admin.categories.index')
            ],

            [
               'name' => 'Crear categorias',
               'icon' => 'fas fa-folder-plus admin-icon-style',
               'route' => route('admin.categories.create'),
               'active' => request()->routeIs('admin.categories.create')
            ],
         ],
         
      ],

      [
         'name' => 'Subcategorias',
         'icon' => 'fas fa-folder admin-icon-style',
         'active' => request()->routeIs('admin.subcategories.*'),
         'submenu' => [
            [
               'name' => 'Lista de subcategorias',
               'icon' => 'fas fa-folder-open admin-icon-style',
               'route' => route('admin.subcategories.index'),
               'active' => request()->routeIs('admin.subcategories.index')
            ],

            [
               'name' => 'Crear subcategorias',
               'icon' => 'fas fa-folder-plus admin-icon-style',
               'route' => route('admin.subcategories.create'),
               'active' => request()->routeIs('admin.subcategories.create')
            ],
         ],
         
      ],

      [
         'name' => 'Niveles',
         'icon' => 'fas fa-signal admin-icon-style',
         'active' => request()->routeIs('admin.levels.*'),
         'submenu' => [
            [
               'name' => 'Lista de Niveles',
               'icon' => 'fas fa-layer-group admin-icon-style',
               'route' => route('admin.levels.index'),
               'active' => request()->routeIs('admin.levels.index')
            ],

            [
               'name' => 'Crear Niveles',
               'icon' => 'fas fa-paint-brush admin-icon-style',
               'route' => route('admin.levels.create'),
               'active' => request()->routeIs('admin.levels.create')
            ],
         ],
         
      ],

      [
         'name' => 'Precios',
         'icon' => 'fas fa-money-check-alt admin-icon-style',
         'active' => request()->routeIs('admin.prices.*'),
         'submenu' => [
            [
               'name' => 'Lista de Precios',
               'icon' => 'fas fa-bars admin-icon-style',
               'route' => route('admin.prices.index'),
               'active' => request()->routeIs('admin.prices.index')
            ],

            [
               'name' => 'Crear Precios',
               'icon' => 'fas fa-hand-holding-usd admin-icon-style',
               'route' => route('admin.prices.create'),
               'active' => request()->routeIs('admin.prices.create')
            ],
         ],
         
      ],

      [
         'header' => 'Administrar pagos a profesores'
      ],

      [
         'name' => 'Pagos profesores',
         'icon' => 'fas fa-book admin-icon-style',
         'active' => request()->routeIs('admin.teachers-payments.*'),
         'submenu' => [
            [
               'name' => 'Lista de pagos a profesores',
               'icon' => 'fas fa-clipboard-list admin-icon-style',
               'route' => route('admin.teachers-payments.index'),
               'active' => request()->routeIs('admin.teachers-payments.index')
            ],
            // [
            //    'name' => 'Crear posts',
            //    'icon' => 'fas fa-pencil-alt admin-icon-style',
            //    'route' => route('admin.posts.create'),
            //    'active' => request()->routeIs('admin.posts.create')
            // ],

         ]
      ],

      [
         'header' => 'Administrar Blog'
      ],

      [
         'name' => 'Posts',
         'icon' => 'fas fa-book admin-icon-style',
         'active' => request()->routeIs('admin.posts.*'),
         'submenu' => [
            [
               'name' => 'Lista de posts',
               'icon' => 'fas fa-clipboard-list admin-icon-style',
               'route' => route('admin.posts.index'),
               'active' => request()->routeIs('admin.posts.index')
            ],
            [
               'name' => 'Crear posts',
               'icon' => 'fas fa-pencil-alt admin-icon-style',
               'route' => route('admin.posts.create'),
               'active' => request()->routeIs('admin.posts.create')
            ],

         ]
      ],

      [
         'name' => 'Categorias',
         'icon' => 'fas fa-folder admin-icon-style',
         'active' => request()->routeIs('admin.post_categories.*'),
         'submenu' => [
            [
               'name' => 'Lista de categorias',
               'icon' => 'fas fa-folder-open admin-icon-style',
               'route' => route('admin.post_categories.index'),
               'active' => request()->routeIs('admin.post_categories.index')
            ],
            [
               'name' => 'Crear categorias',
               'icon' => 'fas fa-folder-plus admin-icon-style',
               'route' => route('admin.post_categories.create'),
               'active' => request()->routeIs('admin.post_categories.create')
            ],

         ]
      ],

      [
         'name' => 'Etiquetas',
         'icon' => 'fas fa-tag admin-icon-style',
         'active' => request()->routeIs('admin.tags.*'),
         'submenu' => [
            [
               'name' => 'Lista de etiquetas',
               'icon' => 'fas fa-tags admin-icon-style',
               'route' => route('admin.tags.index'),
               'active' => request()->routeIs('admin.tags.index')
            ],
            [
               'name' => 'Crear etiquetas',
               'icon' => 'fas fa-edit admin-icon-style',
               'route' => route('admin.tags.create'),
               'active' => request()->routeIs('admin.tags.create')
            ],

         ]
      ],

      [
         'name' => 'Api posts',
         'icon' => 'fas fa-rocket admin-icon-style',
         'active' => request()->routeIs('admin.api.posts.*'),
         'submenu' => [
            [
               'name' => 'Recuperar posts',
               'icon' => 'fas fa-infinity admin-icon-style',
               'route' => route('admin.api.posts.index'),
               'active' => request()->routeIs('admin.api.posts.index')
            ],

         ]
      ],

   ];

@endphp

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" 
   :class="{
      'transform-none': open,
      '-translate-x-full': !open
   }" aria-label="Sidebar">
   <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
       <ul class="space-y-2 font-medium">
         @foreach ($links as $link)

            <li>
               @isset($link['header'])
                  <div class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase">
                     {{$link['header']}}
                  </div>
               @else

                  @isset($link['submenu'])
                     <div x-data="{ open: {{$link['active'] ? 'true' : 'false'}} }">

                        <button class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{$link['active'] ? 'bg-gray-100' : ''}} w-full" 
                        x-on:click="open = !open">
                           <span class="inline-flex w-6 h-6 justify-center items-center">
                              <i class="{{$link['icon']}}"></i>
                           </span>
                           <span class="ms-3 text-left flex-1">{{$link['name']}}</span>
                           <i class="fa-solid fa-angle-down" :class="{'fa-angle-down': !open, 'fa-angle-up': open}"></i>
                        </button>

                        <ul x-show="open" style="display:none" class="mt-1">
                           @foreach ($link['submenu'] as $item)

                              <li class="pl-4">
                                 <a href="{{$item['route']}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{$item['active'] ? 'bg-gray-100' : ''}}">
                                    <span class="inline-flex w-6 h-6 justify-center items-center">
                                       <i class="{{$item['icon']}}"></i>
                                    </span>
                                    <span class="ms-3">{{$item['name']}}</span>
                                 </a>
                              </li>

                           @endforeach
                        </ul>
                     </div>
                  @else
                     <a href="{{$link['route']}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{$link['active'] ? 'bg-gray-100' : ''}}">
                        <span class="inline-flex w-6 h-6 justify-center items-center">
                           <i class="{{$link['icon']}}"></i>
                        </span>
                        <span class="ms-3">{{$link['name']}}</span>
                     </a>
                  @endisset

               @endisset
            </li>

          @endforeach
       </ul>
   </div>
</aside>