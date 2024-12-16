@props(['course'])

@php

//duracionn del curso en segundos
$duration = $course->lessons->where('is_published', '=', 1)->sum('duration');

//Calcular horas, minutos y segundos
$horas = floor($duration / 3600);
$minutos = floor(($duration % 3600) / 60);
$segundos = $duration % 60;

//Formatear la salida
$totalTime = sprintf('%2dh %02dm', $horas, $minutos);

@endphp

<div>
    <div class="w-full rounded overflow-hidden shadow-lg mt-8 md:h-[650px]">
        <img class="w-full" src="{{$course->image}}" alt="Sunset in the mountains">
        <div class="px-6 py-4">
          <div class="font-bold text-xl mb-2">{{$course->title}}</div>
            <div class="grid gap-4 lg:grid-cols-2 mt-6">
              <p>
                <a href="#" class="cursor-pointer inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2 hover:bg-violet-500 hover:text-white">
                {{$course->category->name}}
                </a>
              </p>
              <p class="flex text-lg font-semibold mb-2">
                @if ($course->price->value == 0)
                    <span class="text-green-500">Gratis</span>
                @else
                    {{number_format($course->price->value, 2) . ' USD'}}
                @endif
              </p>
            </div>
            <div class="grid gap-4 md:grid-cols-2 mt-2">
              <p><span class="text-violet-500 pr-2"><i class="fas fa-signal"></i></span><span>{{$course->level->name}}</span></p>
              <p><span class="text-violet-500 pr-2"><i class="fas fa-clock"></i></span><span>{{$totalTime}}</span></p>
            </div>
        
            {{-- <p class="text-gray-700 text-base mt-6">
              descripcion corta
            </p> --}}
        </div>

        <div class="px-6 py-4">
          <a href="{{route('courses.show', $course)}}" class="text-sm font-semibold text-gray-700 underline hover:text-violet-500">
            VER CURSO <span class="hover:text-violet-500 text-xl font-semibold"><i class="fas fa-arrow-right"></i></span>
          </a>
        </div>
        <div class="px-6 pt-4 pb-2">
          {{-- @dump($course->subcategories) --}}
          @foreach ($course->subcategories as $subcategory)
            <span class="cursor-pointer inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2 hover:bg-violet-500 hover:text-white">
              #{{$subcategory->name}}
            </span>
          @endforeach
          
          {{-- <span class="cursor-pointer inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2 hover:bg-violet-500 hover:text-white">#travel</span>
          <span class="cursor-pointer inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2 hover:bg-violet-500 hover:text-white">#winter</span> --}}
        </div>
      </div>

</div>