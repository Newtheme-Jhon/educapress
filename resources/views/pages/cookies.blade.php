<x-app-layout>
    <x-container>
        <div class="card mt-8 pt-4 pb-6">
            <h2 class="font-kumb text-3xl mb-3">
                Política de Cookies de {{env('APP_NAME')}}
            </h2>

            <p class="font-semibold underline mb-2 text-lg pt-4">
                ¿Qué son las cookies?
            </p>
            <p>
                Las cookies son pequeños archivos de texto que se almacenan en tu dispositivo cuando visitas un sitio web. <br>
                Estas cookies permiten a los sitios web recordar tus preferencias y mejorar tu experiencia de navegación.
            </p>
            <p class="font-semibold underline mb-2 text-lg pt-4">
                ¿Cómo utilizamos las cookies en {{env('APP_NAME')}}?
            </p>

            <p class="font-semibold pb-2">
                Utilizamos cookies tanto propias como de terceros para:
            </p>

            <p>
                <ul class="list-disc ml-4">
                    <li><b>Mejorar la experiencia del usuario:</b> Personalizar tu experiencia en la plataforma, recordar tus preferencias y facilitar la navegación.</li>
                    <li><b>Recolectar datos analíticos:</b> Obtener información sobre cómo utilizas nuestra plataforma para mejorar nuestros servicios y contenido.</li>
                    <li><b>Mostrar publicidad relevante:</b> Presentarte anuncios personalizados basados en tus intereses.</li>
                </ul>
            </p>
            <p class="font-semibold pt-4 pb-2">
                Tipos de cookies que utilizamos:
            </p>

            <p>
                <ul class="list-disc ml-4">
                    <li><b>Cookies estrictamente necesarias:</b> Estas cookies son esenciales para el funcionamiento básico de nuestra plataforma y te permiten navegar por ella y utilizar sus funciones.</li>
                    <li><b>Cookies de rendimiento:</b> Estas cookies recopilan información sobre cómo utilizas nuestra plataforma, como las páginas que visitas con más frecuencia.</li>
                    <li><b>Cookies de funcionalidad:</b> Estas cookies permiten a nuestra plataforma recordar tus elecciones (por ejemplo, tu idioma preferido) y ofrecerte una experiencia más personalizada.</li>
                    <li><b>Cookies de publicidad:</b> Estas cookies se utilizan para mostrar anuncios relevantes en nuestra plataforma y en otros sitios web.</li>
                </ul> 
            </p>
            <p class="font-semibold underline mb-2 text-lg pt-4">
                ¿Cómo controlar las cookies?
            </p>
            <p>
                Puedes controlar y gestionar las cookies a través de la configuración de tu navegador. <br>
                Sin embargo, ten en cuenta que deshabilitar las cookies puede afectar el funcionamiento de nuestra plataforma.
            </p>
        </div>
    </x-container>
</x-app-layout>