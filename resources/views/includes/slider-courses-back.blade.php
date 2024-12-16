<x-container>
    <div class="mb-6 mt-4">
        <h1 class="text-4xl font-kumb text-center">
            Nuestros cursos
        </h1>
        <p class="text-center mt-3">
            Aquí puedes ver algunos de nuestros cursos. <br> 
            ¡No te quedes atrás! Únete a nuestra comunidad de aprendizaje.
        </p>
    </div>

    <div class="slider">
        <div class="slider-track space-x-3">
            @foreach ($courses as $course)

            {{-- @dump($course->image) --}}
                <div class="slide">
                    <div class="card">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-2">
                                <figure>
                                    <a class="cursor-pointer" href="{{route('courses.show', $course)}}">
                                        <img class="w-16 h-16 object-cover rounded-full" 
                                        src="{{strripos($course->image, '.png') ? $course->image : 'https://cdn.pixabay.com/photo/2021/12/09/19/01/globe-6858907_1280.jpg'}}" alt="">
                                    </a>
                                </figure>
                            </div>
                            <div class="col-span-4">
                                <a href="{{route('courses.show', $course)}}" class="text-lg font-semibold mb-4">
                                    {{substr($course->title, 0, 40)}}...
                                </a>
                            </div>
                        </div>
                       
                        <div class="course">
                            <div class="p-3">
                                <p class="text-gray-600"><span class="font-semibold">Profesor:</span> {{$course->teacher->name}}</p>
                                <p class="text-gray-600"><span class="font-semibold">Duracion:</span> 10 horas</p>
                                <div class="flex items-center">
                                    <div><span class="font-semibold text-gray-600">Valoración: </span></div>
                                    <div class="ml-1">
                                        <ul class="flex text-xs space-x-1">

                                            @php
                                                $reviews = $course->reviews->pluck('rating');
                                                $totalReviews = $course->reviews->count();
                                                $promedioReviews = $reviews->sum() / $totalReviews;
                                                $total = $totalReviews <= 0 ? 5 : round($promedioReviews);
                                            @endphp

                                            @for ($i = 0; $i < $total; $i++)
                                                <li>
                                                    <i class="fa-solid fa-star text-indigo-500"></i>
                                                </li>
                                            @endfor

                                        </ul>
                                    </div>
            
                                </div>
            
                                <div class="mt-3 flex justify-between font-medium pb-4">
                                    <div>
                                        @if ($course->price->value == 0)
                                            <span class="text-green-500">Gratis</span>
                                        @else
                                            Precio: {{number_format($course->price->value, 2) . ' USD'}}
                                        @endif
                                    </div>
                                    <a class="btn btn-purple" href="{{route('courses.show', $course)}}">
                                        Ver curso
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</x-container>

<style>
    .slider{
        width: 100%;
        height: auto;
        margin: auto;
        overflow: hidden;
        border-color: black;
        border-width: medium;
    }

    .slider .slider-track{
        display: flex;
        animation: scroll 30s linear infinite;
        -webkit-animation: scroll 30s linear infinite;
        width: calc(410px * 6)
    }

    .slider .slide{
        width: 410px;
    }

    @keyframes scroll{
        0%{
            -webkit-transform: translatex(0);
            transform: translatex(0);

        }
        100%{
            -webkit-transform: translatex(calc(-410px * 3));
            transform: translatex(calc(-410px * 3));

        }
    }
</style>