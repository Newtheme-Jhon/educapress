@props(['course'])

@php

    $reviews = $course->reviews->pluck('rating');
    $totalReviews = $course->reviews->count();
    if($totalReviews > 0)
    {
        $promedioReviews = $reviews->sum() / $totalReviews;
    }else
    {
        $promedioReviews = 5;
    }

    //devolver solo dos decimales
    $promedioReviews = number_format($promedioReviews, 2);

@endphp

<!-- component -->
<div class="w-[260px] sm:w-[300px] md:w-[220px] lg:w-[260px]">
    <a class="" href="{{route('courses.status', $course)}}">
        <div class="card h-[150px] w-[260px] sm:w-[300px] md:w-[220px] md:h-[120px] lg:w-[260px] lg:h-[150px]" style="background-image:url({{Storage::url($course->image_path)}}); background-position:center; background-size:cover; background-repeat:no-repeat;">
        </div>
    </a>
    <a class="hover:text-indigo-500 underline" href="{{route('courses.status', $course)}}">
        <h5 class="mt-1 font-semibold text-sm">
            {{$course->title}}
        </h5>
    </a>
    <div class="flex">
        <div>
            <ul class="flex space-x-1">
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
        </div>
        <div class="px-2">
            {{$promedioReviews}}
        </div>
    </div>
</div>