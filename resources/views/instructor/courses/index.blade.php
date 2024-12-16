<x-instructor-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de Cursos
        </h2>
    </x-slot>

    <x-container class="mt-12">

        <div class="md:flex md:justify-end mb-6">
            <a href="{{route('instructor.courses.create')}}" class="btn btn-red">Crear curso</a>
        </div>
        <ul>

            @forelse ($courses as $course)
                <li class="bg-white rounded-lg shadow-lg overflow-hidden mb-4">
                    <a href="{{route('instructor.courses.edit', $course)}}" class="md:flex">
                        <figure class="flex-shrink-0">
                            <img src="{{$course->image}}" alt="curso" class="w-full md:w-36 aspect-video md:aspect-square object-cover object-center">
                        </figure>

                        <div class="flex-1">
                            <div class="py-4 px-8">
                                <div class="grid md:grid-cols-9">
                                    <div class="md:col-span-3">
                                        <h1>{{$course->title}}</h1>
                                        
                                        @switch($course->status->name)
                                            @case('BORRADOR')
                                                <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                                                    {{$course->status->name}}
                                                </span>
                                                @break
                                            @case('PENDIENTE')
                                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">
                                                    {{$course->status->name}}
                                                </span>
                                                @break
                                            @case('PUBLICADO')
                                                <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                                    {{$course->status->name}}
                                                </span>
                                                @break
                                                
                                        @endswitch
                                    </div>
                                    <div class="hidden md:block col-span-2">
                                        <p class="text-sm font-bold">
                                            @php
                                                $valor = "0";
                                            @endphp
                                            @foreach ($course->teacher_payments as $payment)
                                                @if ($payment->payment_teacher)
                                                    @php
                                                        $valor = $teacher_payment->where('course_id', $payment->course_id)->sum('payment_teacher');
                                                        // $valor = TeacherPayment::where('course_id', $payment->course_id)->sum('payment_teacher');
                                                    @endphp
                                                @endif
                                            @endforeach

                                            {{$valor}} USD
                                        </p>
                                        
                                        <p class="mb-1 text-sm">Ganado este mes</p>
                                        
                                        <p class="text-sm font-bold">PVP. {{$course->price->value}} USD</p>
                                    </div>
                                    <div class="hidden md:block col-span-2">
                                        <p>
                                            {{$course->students->count()}}
                                        </p>
                                        <p class="text-sm">Inscripciones este mes</p>
                                    </div>
                                    <div class="hidden md:block col-span-2">
                                        <div class="flex justify-end">
                                            <p class="mr-3">
                                                @php
                                                    $promedio = \App\Http\Controllers\Instructor\CourseController::calcularPromedio($course);
                                                @endphp
                                                {{$promedio}}
                                            </p>
                                            <ul class="text-xs space-x-1 flex items-center">
                                                <i class="fa-solid fa-star text-yellow-500"></i>
                                                <i class="fa-solid fa-star text-yellow-500"></i>
                                                <i class="fa-solid fa-star text-yellow-500"></i>
                                                <i class="fa-solid fa-star text-yellow-500"></i>
                                                <i class="fa-solid fa-star text-yellow-500"></i>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </a>
                </li>

                @empty
                    
                <li class="bg-white rounded-lg shadow-lg overflow-hidden p-6">
                    <div class="block md:flex justify-between items-center">
                        <p class="mb-4 md:mb-0">Explota tu potencial, Convierte tu pasión en profesión.</p>
                        <a class="btn btn-blue" href="{{route('instructor.courses.create')}}">Crea tu curso</a>
                    </div>
                </li>
                
            @endforelse
            
        </ul>
    </x-container>

</x-instructor-layout>