<x-app-layout>
    <x-container>
        <div class="card mt-8 pt-4 pb-6">
            <h2 class="font-kumb text-3xl mb-3">
                Términos y Condiciones de Uso de {{env('APP_NAME')}}
            </h2>

            <p class="font-semibold pb-2">
                1. Aceptación de los Términos
            </p>
            <p class="condiciones-sub-indice">
                Al acceder o utilizar {{env('APP_NAME')}}, aceptas estar sujeto a estos Términos y Condiciones. Si no estás de acuerdo con estos términos, por favor, abstente de utilizar nuestra plataforma.
            </p>

            <p class="font-semibold pb-2 pt-3">
                2. Descripción de {{env('APP_NAME')}}
            </p>
            <p class="condiciones-sub-indice">
                {{env('APP_NAME')}} es una plataforma en línea que conecta a instructores y estudiantes, permitiendo la creación, compra y venta de cursos, proyectos y otros materiales educativos.
            </p>

            <p class="font-semibold pb-2 pt-3">
                3. Registro y Cuenta de Usuario
            </p>
            <p class="condiciones-sub-indice">
                Para utilizar {{env('APP_NAME')}}, debes registrarte y crear una cuenta. Eres responsable de mantener la confidencialidad de tu información de acceso.
            </p>

            <p class="font-semibold pb-2 pt-3">
                4. Uso de la Plataforma
            </p>
            <p class="condiciones-sub-indice">
                <ul class="list-disc pl-[30px] sm:pl-[40px]">
                    <li>Uso permitido: Puedes utilizar {{env('APP_NAME')}} para acceder a cursos, comprar materiales educativos, interactuar con otros usuarios y crear contenido educativo.</li>
                    <li>Uso prohibido: Está prohibido utilizar {{env('APP_NAME')}} para fines ilegales, dañinos o que infrinjan los derechos de terceros.</li>
                </ul>
            </p>

            <p class="font-semibold pb-2 pt-3">
                5. Contenido del Usuario
            </p>
            <p class="condiciones-sub-indice">
                <ul class="list-disc pl-[30px] sm:pl-[40px]">
                    <li>Responsabilidad: Eres el único responsable del contenido que subes a {{env('APP_NAME')}}.</li>
                    <li>Licencia: Al subir contenido, nos otorgas una licencia no exclusiva para utilizarlo y mostrarlo en nuestra plataforma.</li>
                    <li>Eliminación de contenido: Nos reservamos el derecho de eliminar cualquier contenido que infrinja estos Términos o las leyes aplicables.</li>
                </ul>
            </p>

            <p class="font-semibold pb-2 pt-3">
                6. Propiedad Intelectual
            </p>
            <p class="condiciones-sub-indice">
                Todos los derechos de propiedad intelectual de {{env('APP_NAME')}} y su contenido pertenecen a {{env('APP_NAME')}} o a sus licenciantes.
            </p>

            <p class="font-semibold pb-2 pt-3">
                7. Pagos y reembolsos
            </p>
            <p class="condiciones-sub-indice">
                <ul class="list-disc pl-[30px] sm:pl-[40px]">
                    <li>Pagos: Los pagos se realizan a través de los métodos de pago disponibles en la plataforma.</li>
                    <li>Reembolsos: Nuestra política de reembolsos se detalla en una sección separada.</li>
                </ul>
            </p>

            <p class="font-semibold pb-2 pt-3">
                8. Limitación de responsabilidad
            </p>
            <p class="condiciones-sub-indice">
                {{env('APP_NAME')}} no se hace responsable por daños directos, indirectos o consecuentes derivados del uso de la plataforma.
            </p>

            <p class="font-semibold pb-2 pt-3">
                9. Modificación de los Términos
            </p>
            <p class="condiciones-sub-indice">
                Nos reservamos el derecho de modificar estos Términos en cualquier momento.
            </p>

            <p class="font-semibold pb-2 pt-3">
                10. Ley aplicable y jurisdicción
            </p>
            <p class="condiciones-sub-indice">
                Estos Términos se rigen por las leyes de [Tu país]. Cualquier disputa se resolverá en los tribunales de [Tu ciudad].
            </p>

            <p class="font-semibold pb-2 pt-3">
                11. Contacto
            </p>
            <p class="condiciones-sub-indice">
                <ul class="list-disc pl-[30px] sm:pl-[40px]">
                    <li>Para cualquier consulta relacionada con estos Términos, puedes contactarnos a través de info@<span class="lowercase">{{env('APP_NAME')}}</span>.es.</li>
                    <li>{{env('APP_NAME')}}</li>
                    <li>Noviembre 20/2024</li>
                    <li>
                        <a class="underline hover:text-blue-600" href="{{route('pages.privacidad')}}">
                            Política de privacidad
                        </a>
                    </li>
                    <li>
                        <a class="underline hover:text-blue-600" href="{{route('pages.cookies')}}">
                            Política de cookies
                        </a>
                    </li>
                </ul>
            </p>
        </div>
    </x-container>

    <style>
        .condiciones-sub-indice{
            padding-left: 20px;
        }
    </style>
</x-app-layout>