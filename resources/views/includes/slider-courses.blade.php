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

    <div class="container-swiper">

        <div class="swiper" id="swiperCourses">
            <div class="swiper-wrapper space-x-3 h-[450px]">
                
                @foreach ($courses as $course)

                    {{-- @dump($course->image) --}}
                    @if ($course->status == 3) 
                        <div class="swiper-slide h-[400px]">
    
                            <a href="{{route('courses.show', $course)}}">
                                <figure>
                                    <img src="{{Storage::url($course->image_path)}}" alt="">
                                    {{-- <img src="{{asset('img/03.jpg')}}" alt=""> --}}
                                </figure>
                            </a>
                            <div class="card-description">
                                <div class="card-title">
                                    <p class="font-semibold">
                                        Titulo:
                                    </p>
                                    <h4 class="text-gray-700 hover:text-blue-500">
                                        <a href="{{route('courses.show', $course)}}">
                                            {{substr($course->title, 0, 40)}}...
                                        </a>
                                    </h4>

                                    <ul class="flex text-xs space-x-1 mt-1">

                                        @php
                                            //reviews
                                            if($course->reviews->count()){
                                                $reviews = $course->reviews->pluck('rating');
                                                $totalReviews = $course->reviews->count();
                                                $promedioReviews = $reviews->sum() / $totalReviews;
                                                $total = $totalReviews <= 0 ? 5 : round($promedioReviews);
                                            }else{
                                                $total = 5;
                                            }

                                        @endphp

                                        @for ($i = 0; $i < $total; $i++)
                                            <li>
                                                <i class="fa-solid fa-star text-indigo-500"></i>
                                            </li>
                                        @endfor
                                    </ul>
                                    
                                </div>
                                <div class="card-text">
                                    <p>
                                        <span class="font-semibold">Duración: </span>
                                        <span class="text-gray-700">{{$courseTime[$course->id]}}</span>
                                    </p>
                                </div>
                                <div class="card-link mt-4">
                                    <a href="{{route('courses.show', $course)}}">Ver más</a>
                                </div>
                            </div>

                        </div>
                    @endif
                    
                @endforeach

            </div>

            <!-- If we need pagination -->
            <div class="swiper-pagination" id="swiper-pagination-course"></div>

            <div class="swiper-button-next" id="next-course"></div>
            <div class="swiper-button-prev" id="prev-course"></div>
        </div>
    </div>
</x-container>

<style>
.container-swiper .swiper-slide {
  position: relative;
  text-align: center;
  font-size: 18px;
  background: #fff;
  border-radius: 15px;
  text-align: start;
  box-shadow: 0px 4px 4px rgba(196, 196, 196, 0.25);
  display: grid;
 
}
.container-swiper .swiper-slide img{
   display: block;
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;

}
.container-swiper .swiper-slide .card-description{
    padding:1rem 1rem;
}
.container-swiper .swiper-slide .card-title,.container .swiper-slide .card-text{
   margin-bottom: .5rem;
}
.container-swiper .swiper-slide .card-link{
   text-align: center;
  
}
.container-swiper .swiper-slide .card-link a{
    text-decoration: none;
    color: #1d6ce2;
}
</style>

