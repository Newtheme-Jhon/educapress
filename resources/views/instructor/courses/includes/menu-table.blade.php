@php
  $links = [
    [
      'name'    => 'Información del curso',
      'route'   => route('instructor.courses.edit', $course),
      'active'  => request()->routeIs('instructor.courses.edit')
    ],
    [
      'name'    => 'Video promocional',
      'route'   => route('instructor.courses.video', $course),
      'active'  => request()->routeIs('instructor.courses.video')
    ],
    [
      'name'    => 'Metas del curso',
      'route'   => route('instructor.courses.goals', $course),
      'active'  => request()->routeIs('instructor.courses.goals')
    ],
    [
      'name'    => 'Requisitos del curso',
      'route'   => route('instructor.courses.requirements', $course),
      'active'  => request()->routeIs('instructor.courses.requirements')
    ],
    [
      'name'    => 'Curriculum',
      'route'   => route('instructor.courses.curriculum', $course),
      'active'  => request()->routeIs('instructor.courses.curriculum')
    ],
    [
      'name'    => 'Estudiantes',
      'route'   => route('instructor.courses.students', $course),
      'active'  => request()->routeIs('instructor.courses.students')
    ],

  ];
@endphp

<div class="relative flex flex-col w-full h-full overflow-hidden text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
    <table class="w-full text-left table-auto min-w-max">
      <thead>
        <tr>
          <th class="p-4 border-b border-slate-300 bg-slate-300">
            <h1 class="block text-lg font-semibold leading-none text-slate-800">
              Edición del curso
            </h1>
          </th>
        </tr>
      </thead>
      <tbody>
        @foreach ($links as $link)

          <tr class="{{ $link['active'] ? 'bg-indigo-400' : 'hover:bg-slate-50' }}">
            <td class="p-4 border-b border-slate-200">
              <a href="{{ $link['route'] }}" class="block text-sm font-semibold {{ $link['active'] ? 'text-white' : 'text-slate-500 ' }}">
                {{ $link['name'] }}
                {{-- {{dump($link['active'])}} --}}
              </a>
            </td>
          </tr>

        @endforeach
      </tbody>
    </table>
</div>

<div class="flex mt-4">

  @if ($course->status->value == 2)
    <div class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
      <span class="font-semibold">Curso en revisión</span>
    </div>
  @elseif ($course->status->value == 3)
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
      <span class="font-semibold">Curso aprobado</span>
    </div>
  @else
    <form action="{{route('instructor.courses.status', $course)}}" method="POST">
      @csrf
      <x-button>Enviar para revisión</x-button>
    </form>
  @endif

</div>

<!--boton para ver las observaciones-->
<div class="flex mt-4">
  @if ($course->observation()->get()->last() && $course->status->value == 1)
    <a href="{{route('instructor.courses.observations', $course)}}" class="btn btn-blue uppercase text-sm">Ver observaciones</a>
  @endif
</div>