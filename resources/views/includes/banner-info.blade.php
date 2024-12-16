<div class="my-8 background-gradient">
    <x-container>
        <div class="grid md:grid-cols-2 gap-6">
            <div class="col-span-1 md:h-[600px] my-8 md:my-0 flex items-center justify-center">
                <div class="px-4">
                    <h3 class="text-4xl font-semibold">
                        Desarrolla las habilidades que necesitan las empresas. <br>
                        ¡Únete a nuestra comunidad!
                    </h3>
                    <p class="mt-4">
                        En nuestra plataforma encontrarás una amplia gama de cursos diseñados 
                        para impulsar tu carrera profesional. Desde programación y diseño 
                        web hasta marketing digital y gestión de proyectos, 
                        tenemos todo lo que necesitas para alcanzar tus objetivos."
                    </p>
                </div>
            </div>
            <div class="col-span-1 h-[600px] bg-image" style="background-image: url({{asset('img/welcome/dcd.png')}});">
            </div>
        </div>
    </x-container>
</div>

<style>
    .background-gradient{
        background-color: white;
    }
    .bg-image{
        background-position: center center;
        background-size: cover;
        background-repeat: no-repeat;
    }
</style>

