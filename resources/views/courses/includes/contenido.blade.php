<div class="grid gap-4 lg:grid-cols-2 mt-[60px]">

    <!--goals: lo que el alumno va a aprender-->
    <div class="contenido">
        <h2 class="text-3xl font-semibold py-4">Lo que vas a aprender</h2>
        <ul class="mb-4">
            @forelse ($course->goals as $goal)
                <li>
                    <span class="text-violet-500 pr-2 font-bold text-xl"><i class="fas fa-check"></i></span>
                    <span>{{$goal->name}}</span>
                </li>
            @empty
                <li>
                    Este curso no tiene metas
                </li>
            @endforelse
        </ul>
    </div>

    <!--bullet points-->
    <div class="grid gap-4 grid-cols-1 sm:grid-cols-2">

        <!--formato del curso-->
        <div class="w-full md:max-w-[18rem] bg-white border border-gray-200 rounded-lg shadow ligth:bg-gray-800 dark:border-gray-100 py-4">
            <div class="flex justify-center">
                <div>
                    <i class="fa-solid fa-school-circle-check text-4xl text-indigo-500"></i>
                </div>
            </div>
            <div class="p-5">
                <a href="#">
                    <h5 class="mb-2 mt-4 text-2xl font-bold tracking-tight text-gray-900 ligth:text-black">Formato del curso</h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    <span class="text-violet-500 pr-2 font-bold text-xl">
                    <i class="fas fa-check"></i>
                    </span> Video Tutoriales
                </p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    <span class="text-violet-500 pr-2 font-bold text-xl">
                    <i class="fas fa-check"></i>
                    </span> Proyectos
                </p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    <span class="text-violet-500 pr-2 font-bold text-xl">
                    <i class="fas fa-check"></i>
                    </span>Software
                </p>
            </div>
        </div>

        <!--duración del curso-->
        <div class="w-full md:max-w-[18rem] bg-white border border-gray-200 rounded-lg shadow ligth:bg-gray-800 dark:border-gray-100 py-4">
            <div class="flex justify-center">
                <div>
                    <i class="fa-solid fa-bullhorn text-4xl text-indigo-500"></i>
                </div>
            </div>
            <div class="p-5">
                <a href="#">
                    <h5 class="mb-2 mt-4 text-2xl font-bold tracking-tight text-gray-900 ligth:text-black">Duración del curso</h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    <span class="text-violet-500 pr-2 font-bold text-xl">
                    <i class="fas fa-check"></i>
                    </span> {{$totalTime}}
                </p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    <span class="text-violet-500 pr-2 font-bold text-xl">
                    <i class="fas fa-check"></i>
                    </span> {{$totalLessons}} Videoclases
                </p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    <span class="text-violet-500 pr-2 font-bold text-xl">
                    <i class="fas fa-check"></i>
                    </span> Consultas online
                </p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    <span class="text-violet-500 pr-2 font-bold text-xl">
                    <i class="fas fa-check"></i>
                    </span> Webinar semanal
                </p>
            </div>
        </div>

    </div>
    <!--/-->
 </div>