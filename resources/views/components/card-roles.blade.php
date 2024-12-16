<a class="cursor-pointer flex flex-col lg:w-[900px] items-center bg-white border border-gray-200 rounded-lg shadow lg:flex-row lg:max-w-[1000px] hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
    <img class="object-cover w-full rounded-t-lg h-96 lg:h-[400px] lg:w-[300px] lg:rounded-none lg:rounded-s-lg" src="https://img.freepik.com/foto-gratis/avatar-androgino-persona-queer-no-binaria_23-2151100221.jpg?t=st=1727529720~exp=1727533320~hmac=31549614a95b8c510ec45e75b3065a680ca514d17e10f260a7c9ff0f9b70f592&w=740" alt="">
    <div class="flex w-full flex-col justify-between p-4 leading-normal">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$title}}</h5>
        <div class="flex">
            {{$slot}}
        </div>
    </div>
</a>