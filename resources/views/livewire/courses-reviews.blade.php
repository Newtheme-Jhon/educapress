<div>
    <div class="grid grid-cols-6">
        <div class="col-span-6">
            <h1 class="text-3xl font-semibold">
                Reseñas de los estudiantes
            </h1>
        </div>
    </div>

    <div class="grid grid-cols-6 items-center mt-2">
        <div class="col-span-6 md:col-span-1">
            <h1 class="text-2xl font-semibold">
                {{$promedioReviews}}
            </h1>
            <p>
                <ul class="flex space-x-2">
                    <li>
                        <span><i class="fa-solid fa-star text-indigo-400"></i></span>
                    </li>
                    <li>
                        <span><i class="fa-solid fa-star text-indigo-400"></i></span>
                    </li>
                    <li>
                        <span><i class="fa-solid fa-star text-indigo-400"></i></span>
                    </li>
                    <li>
                        <span><i class="fa-solid fa-star text-indigo-400"></i></span>
                    </li>
                    <li>
                        <span><i class="fa-solid fa-star text-indigo-400"></i></span>
                    </li>
                </ul>
            </p>
            <p>
                {{$total_reviews}} Valoraciones
            </p>
        </div>
        <div class="col-span-5">

        </div>
    </div>

    @can('validateReview', $course)
        <p></p>
    @else
        <div role="alert" class="mt-3 relative flex w-full p-3 text-sm text-white bg-slate-800 rounded-md">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"></path></svg>
            Usted ya tiene una reseña en este curso
        </div>
    @endcan

    <div class="card mt-4">

        @foreach ($reviews as $review)

            <!--_path photo user si hay foto _url photo se genera por default al registrarse
            $review->user->profile_photo_path-->

            <div class="grid grid-cols-6 mb-6 gap-4 items-center">
                <div class="col-span-6 md:col-span-1">
                    <figure>
                        <img 
                        class="w-16 h-16 object-cover rounded-full shadow-lg"
                        src="{{$review->user->profile_photo_url}}" alt="imagen estudiante">
                    </figure>
                </div>

                <div class="col-span-6 md:col-span-5">
                    <div class="card bg-gray-100">
                        <p class="font-semibold">
                            <span>{{ $review->user->name }} </span>
                        </p>
                        <p>
                            @for ($i=0; $i < $review->rating; $i++)
                                <span><i class="fa-solid fa-star text-indigo-400"></i></span>
                            @endfor

                            @php
                                $startBlack = 5 - $review->rating;
                            @endphp

                            @for ($i=0; $i < $startBlack; $i++)
                                <span><i class="fa-solid fa-star text-gray-500"></i></span>
                            @endfor
                        </p>
                        <p>
                            {{$review->review}}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>
