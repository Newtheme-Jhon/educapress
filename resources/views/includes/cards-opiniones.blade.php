<x-container>
    <div class="mt-8">
        <h1 class="text-4xl font-kumb text-center">
            Opiniones de alumnos
        </h1>
        <p class="text-center">Que dicen los estudiantes sobre nuestros cursos</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mt-7" >
        <div class="bg-white pt-2 pb-4 rounded-2xl px-5">
            <img class="mb-1" src="{{ asset('img/welcome/reviews.jpg') }}" alt="icon review" width="50" loading="lazy">
            <p class="mb-4">
              ¡Los cursos de Laravel son increíbles! Gracias a ellos, pude desarrollar mi propia API Rest y 
              crear una aplicación web personalizada desde cero. 
              ¡Totalmente recomendado para cualquier desarrollador que quiera dominar Laravel!
            </p>
            <p class="font-semibold mb-2">Juan Pérez</p>
            <p>Desarrollador Full Stack</p>    
        </div>
        <div class="bg-white pt-2 pb-4 rounded-2xl px-5">
            <img class="mb-1" src="{{ asset('img/welcome/reviews.jpg') }}" alt="icon review" width="50" loading="lazy">
            <p class="mb-4">
                Como principiante en el mundo del desarrollo web, los cursos de WordPress y 
                WooCommerce me han sido de gran ayuda. ¡Estoy encantada con los resultados!
            </p>
            <p class="font-semibold mb-2">María Gómez</p>
            <p>Emprendedora</p>    
        </div>
        <div class="bg-white pt-2 pb-4 rounded-2xl px-5">
            <img class="mb-1" src="{{ asset('img/welcome/reviews.jpg') }}" alt="icon review" width="50" loading="lazy">
            <p class="mb-4">
                Me encanta la variedad de cursos que ofrecen. He aprendido a desarrollar tanto con Laravel como con 
                WordPress, lo que me ha permitido trabajar en proyectos muy diferentes.
            </p>
            <p class="font-semibold mb-2">Carlos Rodríguez</p>
            <p>Freelancer</p>    
        </div>
        <div class="bg-white pt-2 pb-4 rounded-2xl px-5">
            <img class="mb-1" src="{{ asset('img/welcome/reviews.jpg') }}" alt="icon review" width="50" loading="lazy">
            <p class="mb-4">
                Los proyectos prácticos son lo mejor de estos cursos. Me han permitido poner en 
                práctica lo aprendido y crear aplicaciones y sitios web reales. 
                Los recursos adicionales y la comunidad de estudiantes también son muy valiosos.
            </p>
            <p class="font-semibold mb-2">Ana Fernández</p>
            <p>Estudiante de Ingeniería Informática</p>    
        </div>
    </div>
</x-container>