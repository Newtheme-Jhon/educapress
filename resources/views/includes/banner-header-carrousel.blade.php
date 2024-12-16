<div>
    <div class="swiper" id="swiperHeader">
        <div class="swiper-wrapper">
            <!-- Slides -->
            <div class="swiper-slide">
                <div style="background-image: url({{asset('img/welcome/img-1.webp')}})" class="banner-carrousel">
                    <x-container>
                        <div class="flex h-[600px] flex-col justify-center">
                            <div class="grid grid-cols-2 gap-6">
                            <div class="col-span-2 md:col-span-1 order-2 md:order-1 -mt-10 md:mt-0 bg-black opacity-70 py-5 px-5">
                                <div>
                                    <h1 class="font-kumb text-4xl text-white fond-semibold px-4">
                                        Aprende, enseña, crece. <br>
                                        Inscríbete ahora y comienza a construir tu futuro
                                        </h1>
                                        <p class="px-4 text-white text-md mt-4">
                                            Únete a nuestra comunidad de creadores y estudiantes. ¡Juntos, revolucionaremos la educación!
                                        </p>
                                </div>
                            </div>
                            </div>
                        </div>
                    </x-container>
                </div>
            </div>

            <div class="swiper-slide">
                <div style="background-image: url({{asset('img/welcome/img-2.webp')}})" class="banner-carrousel">
                    <x-container>
                        <div class="flex h-[600px] flex-col justify-center">
                            <div class="grid grid-cols-2 gap-6">
                            <div class="col-span-2 md:col-span-1 order-2 md:order-1 -mt-10 md:mt-0 bg-black opacity-70 py-5 px-5">
                                <div>
                                    <h1 class="font-kumb text-4xl text-white fond-semibold px-4">
                                        Crea tu propia academia en línea y llega a miles de estudiantes.
                                    </h1>
                                    <p class="px-4 text-white text-md mt-4">
                                        Accede a un nuevo mercado donde todos ganan. Comparte tus habilidades y descubre nuevas oportunidades. 
                                        ¡La educación colaborativa es el futuro!
                                    </p>
                                </div>
                            </div>
                            </div>
                        </div>
                    </x-container>
                </div>
            </div>

            <div class="swiper-slide">
                <div style="background-image: url({{asset('img/welcome/img-3.webp')}})" class="banner-carrousel">
                    <x-container>
                        <div class="flex h-[600px] flex-col justify-center">
                            <div class="grid grid-cols-2 gap-6">
                            <div class="col-span-2 md:col-span-1 order-2 md:order-1 -mt-10 md:mt-0 bg-black opacity-70 py-5 px-5">
                                <div>
                                    <h1 class="font-kumb text-4xl text-white fond-semibold px-4">
                                        ¡Convierte tus conocimientos en oro!
                                    </h1>
                                    <p class="px-4 text-white text-md mt-4">
                                        Aprende, crea y vende, gana dinero al mismo tiempo que estudias. ¡La educación nunca fue tan rentable! 
                                        Comparte tus proyectos, libros y cursos con el mundo. ¡La mejor manera de monetizar tus habilidades!
                                    </p>
                                </div>
                            </div>
                            </div>
                        </div>
                    </x-container>
                </div>
            </div>

            {{-- <div class="swiper-slide">
                <div style="background-image: url({{asset('img/welcome/img-2.webp')}})" class="banner-carrousel">
                    <x-container>
                        <div class="flex h-[600px] flex-col justify-center">
                            <div class="grid grid-cols-2 gap-6">
                            <div class="col-span-2 md:col-span-1 order-2 md:order-1 -mt-10 md:mt-0 bg-black opacity-70 py-5 px-5">
                                <div>
                                    <h1 class="font-kumb text-4xl text-white fond-semibold px-4">
                                        Domina el desarrollo web. <br>
                                        Inscríbete ahora y comienza a construir tu futuro
                                        </h1>
                                        <p class="px-4 text-white text-md mt-4">
                                        Con nuestros cursos, adquirirás las habilidades necesarias para dar vida a tus ideas. Aprenderás de expertos en la industria y desarrollarás proyectos reales.
                                        </p>
                                </div>
                            </div>
                            </div>
                        </div>
                    </x-container>
                </div>
            </div> --}}

        </div>

        <!-- If we need pagination -->
        <div class="swiper-pagination" id="swiper-pagination-header"></div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev" id="prev-header"></div>
        <div class="swiper-button-next" id="next-header"></div>
    
        <!-- If we need scrollbar -->
        <div class="swiper-scrollbar"></div>
    </div>
</div>

<style>
    .banner-carrousel{
        width: 100%;
        height: 600px;
        background-position: center top;
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>
