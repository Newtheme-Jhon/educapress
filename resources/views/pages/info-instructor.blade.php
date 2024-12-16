<x-app-layout>
    <x-container>
        <div class="card mt-8 pt-4 pb-6">
            <h2 class="font-kumb text-3xl mb-3 pt-2">
                ¡Conviértete en un Emprendedor de la educación  en {{env('APP_NAME')}}!
            </h2>

            <h3 class="font-kumb text-2xl mb-2">Crea, comparte y gana con tu conocimiento.</h3>

            <p class="font-semibold underline mb-2 text-lg">Introducción:</p>

            <p>
                ¿Tienes una pasión por enseñar y quieres generar ingresos mientras 
                impactas la vida de otros? ¡{{env('APP_NAME')}} es tu plataforma! Únete a nuestra 
                comunidad de educadores y emprendedores y forma parte de una nueva economía 
                colaborativa donde el conocimiento es poder.
            </p>

            <p class="font-semibold underline mb-2 text-lg mt-3">
                ¿Por qué elegir {{env('APP_NAME')}}?
            </p>

            <p>
                <ul class="list-disc ml-4">
                    <li><b>Libertad creativa:</b> Diseña cursos, proyectos y libros personalizados y compártelos con el mundo.</li>
                    <li><b>Múltiples fuentes de ingresos:</b> Genera ingresos no solo con tus cursos, sino también con la venta de proyectos, libros y servicios.</li>
                    <li><b>Comunidad global:</b> Conecta con otros educadores, comparte experiencias y aprende de los mejores.</li>
                    <li><b>Herramientas profesionales:</b> Disfruta de una plataforma intuitiva con todas las herramientas necesarias para crear contenido de alta calidad.</li>
                    <li><b>Marketing y promoción:</b> Benefíciate de nuestra red social integrada para promocionar tus cursos y proyectos a una audiencia global.</li>
                    <li><b>Impacto social:</b> Forma parte de una comunidad que promueve el aprendizaje continuo y la innovación.</li>
                </ul>
            </p>

            <p class="font-semibold underline mb-2 text-lg mt-3">
                ¿Qué ofrecemos a nuestros instructores?
            </p>

            <p>
                <ul class="list-disc ml-4">
                    <li><b>Plataforma de creación de cursos:</b> Crea cursos interactivos con videos, cuestionarios y materiales descargables.</li>
                    <li><b>Tienda online:</b> Vende tus cursos, proyectos, libros y servicios directamente desde la plataforma.</li>
                    <li><b>Red social:</b> Conecta con tus estudiantes, recibe comentarios y construye una comunidad en torno a tu contenido.</li>
                    <li><b>Análisis de datos:</b> Obtén información detallada sobre el rendimiento de tus cursos y la interacción de tus estudiantes.</li>
                    <li><b>Soporte técnico:</b> Cuenta con nuestro equipo de soporte para resolver cualquier duda.</li>
                </ul>
            </p>

            <p class="font-semibold underline mb-2 text-lg mt-3">
                ¿Cómo empezar?
            </p>

            <p>
                <ul class="list-decimal ml-4">
                    <li class="mb-2"><b>Regístrate:</b> Primero debes crear una cuenta. Si aún no te has registrado, debes hacerlo. Crear una cuenta es gratis. <a class="btn btn-purple" href="{{route('register')}}">Registrarse</a></li>
                    <li class="mb-2">
                        <p>
                            <b>Envia tu solicitud:</b> Rellena el formulario para darte de alta como tutor. 
                            <b>Es importante que primero te registres en la plataforma</b>, de lo contrario 
                            no podras acceder al formulario, despues de rellenarlo tardaremos menos de 24 
                            horas en aprobarlo. <br>
                        </p>
                        <p class="mt-2">
                            <a class="btn btn-purple" href="{{route('pages.formInstructor')}}">Formulario</a>
                        </p>
                        
                    </li>
                    <li><b>Crea tu perfil:</b> Completa tu perfil con tu experiencia, conocimientos y áreas de interés.</li>
                    <li><b>Crea tu primer curso:</b> Utiliza nuestras herramientas para diseñar y publicar tu primer curso.</li>
                    <li><b>Promociona tu contenido:</b> Comparte tus cursos en tus redes sociales y aprovecha las herramientas de marketing de {{env('APP_NAME')}}.</li>
                </ul>
            </p>

            <p class="font-semibold underline mb-2 text-lg mt-3">
                ¡Únete a la revolución de la educación!
            </p>

            <p class="pb-2">
                {{env('APP_NAME')}} te brinda la oportunidad de compartir tu conocimiento, inspirar a 
                otros y construir un futuro más brillante. <br> ¡Conviértete en un Emprendedor de la educación  hoy mismo!
            </p>
        </div>
    </x-container>
</x-app-layout>