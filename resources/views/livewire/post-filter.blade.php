<div>
    <!--banner header-->
    <div class="banner mt-1 w-full aspect-[3/1] bg-no-repeat bg-cover bg-center-top h-[350px] md:h-[450px]" 
        style="background-image: url({{asset('img/banner-blog-4.webp')}});">
        <x-container class="flex items-center">
            <div class="grid grid-cols-4">
                <div class="col-span-4 md:col-span-3 lg:col-span-2 h-[250px] md:h-[450px] flex items-center">
                    <div class="bg-black opacity-70 py-4 px-4">
                        <p class="text-3xl mb-3 sm:mb-0 font-bold text-white">últimas noticias</p>
                        <p class="py-0 sm:py-6 text-white">
                            Descubre las últimas tendencias y consejos en tecnología ademas de otras areas de estudio.  
                            Sumérgete en nuestro blog y mantente actualizado con los últimos avances, 
                            tutoriales prácticos y noticias de diversos sectores. ¡Aprende algo nuevo cada día!
                        </p>
                        {{-- <p class="mt-6">
                            <a href="{{route('courses.index')}}" 
                            class="bg-purple-800 py-4 px-8 text-white font-bold uppercase text-xs rounded hover:bg-gray-200 hover:text-gray-800">
                            VER CURSOS
                        </a>
                        </p> --}}
                    </div>
                </div>
            </div>
        </x-container>
    </div>

    <x-container class="mt-8">

        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 md:col-span-2 mb-3 md:mb-0">

                <x-select wire:model.live="selectedCategory">
                    <!--aqui se mostraran todas las categorias pues no hay ningun id de categoria-->
                    <option value="">Todas las categorias</option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">
                            {{$category->title}}
                        </option>
                    @endforeach
                </x-select>

            </div>
            <div class="col-span-4">
                <div>
                    <x-input class="w-full mb-2" placeholder="Buscar posts" wire:model.live="search"></x-input>
                </div>
            </div>
        </div>
        {{-- @dump($posts) --}}
        <div class="grid grid-cols-6 gap-6 mt-8">
            <div class="col-span-6 lg:col-span-5">
                @foreach ($posts as $post)
                    
                    
                        <div class="card flex mb-4">
                            <div class="grid grid-cols-5">
                                <div class="col-span-5 lg:col-span-2">
                                    <figure>
                                        <img class="w-full" 
                                        src="{{Storage::url($post->image_path)}}" 
                                        alt="">
                                    </figure>
                                </div>
                                <div class="col-span-5 lg:col-span-3 px-0 lg:px-6 mt-4 lg:mt-0">
                                    <p class="text-lg font-semibold mb-3">
                                        {{$post->title}}
                                    </p>
                                    <p class="mb-2">
                                        <span class="font-semibold">Autor: </span>
                                        {{$post->user->name}}
                                    </p>
                                    <div class="mb-2">
                                        {!! substr($post->excerpt, 0, 100) !!}...
                                    </div>
                                    <p class="mb-3">
                                        <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                            {{$post->category->title}}
                                        </span>
                                    </p>
                                    <p>
                                        <a class="btn btn-purple" href="{{route('posts.show', $post)}}">VER POST</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    

                @endforeach
                <div class="mt-4">
                    {{$posts->links()}}
                </div>
            </div>

            <div class="col-span-6 lg:col-span-1">
                {{-- aqui otros post relacionados --}}
            </div>
        </div>
    </x-container>
    
</div>

    

