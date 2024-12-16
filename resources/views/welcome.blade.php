<x-app-layout>

    <!--banner header-->
    {{-- @include('includes.banner-header-particles') --}}
    @include('includes.banner-header-carrousel')

    <!--buttet points-->
    @include('includes.bullets')

    <!--banner-->
    @include('includes.banner-info')

    <!--banner card courses-->
    @include('includes.slider-courses')

    <!--banner bulletpoints-->
    @include('includes.banner-bulletpoints')
    
    <!--banner course gratis-->
    <x-container>
        <div class="flex rounded-3xl p-7" style="background-image: linear-gradient(92deg, #C7E6F9 0%, #E8D1FE 100%);">
            <div class="flex items-center mt-8">
                <div>
                    <img class="bg-white rounded-full p-2 me-10" src="{{ asset('img/welcome/graduating-student.png') }}" width="100" alt="estudiante">
                </div>
                <div class="grid md:grid-cols-2">
                    <div>
                        Empieza a estudiar un curso gratis ahora
                    </div>
                    <div class="md:ml-2 mt-2 md:mt-0">
                        <a class="text-white bg-cyan-500 rounded-3xl py-1 px-3" href="/cursos">Empezar curso</a>
                    </div>
                </div>
            </div>
        </div>
    </x-container>
    
    
    <!--cards blog-->
    @include('includes.cards-blog')
    
    <!--cards opiniones-->
    @include('includes.cards-opiniones')


  

<style>

#particles-js {
  width: 100%;
  height: 100vh;
  background-color: #19214b;
  background-position: 50% 50%;
}
.banner{
  position: absolute;
    height: 100%;
    align-items: center;
}

/* .swiper {
  width: 600px;
  height: 300px;
} */
</style>

@push('js')

<script src="{{asset('vendor/jquery/jquery.js')}}"></script>
<!--https://swiperjs.com/get-started-->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>

let swiperHeader = new Swiper('#swiperHeader', {
  // Optional parameters
  direction: 'horizontal',
  loop: true,

  // If we need pagination
  pagination: {
    el: '#swiper-pagination-header',
  },

  autoplay: {
    delay: 7000,
  },

  // Navigation arrows
  navigation: {
    nextEl: '#next-header',
    prevEl: '#prev-header',
  },

  // And if we need scrollbar
  scrollbar: {
    el: '.swiper-scrollbar',
  },
});



</script>

<script>
  //alert(1)
  let swiperCourses = new Swiper('#swiperCourses', {

    loop: true,
    navigation: {
	  nextEl: '#next-course',
	  prevEl: '#prev-course'
	},
	slidesPerView: 1,
	spaceBetween: 10,
	// init: false,
	pagination: {
	  el: '#swiper-pagination-course',
	  // clickable: true,
	},

  autoplay: {
    delay: 3000,
  },

	breakpoints: {
	  620: {
		slidesPerView: 1,
		spaceBetween: 20,
	  },
	  680: {
		slidesPerView: 2,
		spaceBetween: 40,
	  },
	  920: {
		slidesPerView: 3,
		spaceBetween: 30,
	  },
	  1240: {
		slidesPerView: 4,
		spaceBetween: 40,
	  },
	} 

});
</script>

@endpush

</x-app-layout>