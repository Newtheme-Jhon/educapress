<x-app-layout>
    <!--prism.js-->
    <link rel="stylesheet" href="{{asset('vendor/prism.js/prism.css')}}">

    <!--banner header-->
    <div class="banner mt-1 w-full aspect-[3/1] bg-no-repeat bg-cover bg-center-top h-[350px] md:h-[450px]" 
        style="background-image: url({{asset('img/banner-blog-4.webp')}});">
        <x-container class="flex items-center">
            <div class="grid grid-cols-4">
                <div class="col-span-4 md:col-span-3 lg:col-span-2 h-[250px] md:h-[450px] flex items-center">
                    <div class="text-white">
                        <h1 class="text-3xl mb-3 sm:mb-0 font-bold">
                            {{$post->title}}
                        </h1>
                        <div class="style-text-ckeditor py-0 sm:py-6">
                            {!! substr($post->excerpt, 0, 150) !!}...
                        </div>
                    </div>
                </div>
            </div>
        </x-container>
    </div>

    <x-container class="mt-8">
        <div class="grid grid-cols-8 gap-6">
            
            <!--post column-->
            <div class="col-span-8 lg:col-span-5">
                <figure>
                    <img 
                    class="w-full h-96 object-cover" 
                    src="{{Storage::url($post->image_path)}}" 
                    alt="">
                </figure>
                <div class="mt-2">
                    <p>
                        <span class="font-semibold">Fecha: </span>
                        <span>{{$post->created_at->format('d/m/Y')}}</span>
                        <span class="pl-4 font-semibold"> Author: </span>
                        <span>{{$post->user->name}}</span>
                    </p>
                </div>
                <div class="mt-3">
                    <h1 class="font-kumb text-2xl font-semibold">
                        {{$post->title}}
                    </h1>
                    <div class="front-ckeditor mt-2 text-gray-600 text-justify">
                        {!! $post->content !!}
                    </div>
                    <p class="mt-6">
                        <span class="font-semibold pr-4">Tags: </span>
                        @foreach ($post->tags as $tag)
                            <span class="bg-green-100 hover:bg-green-300 text-green-800 text-md font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                <a href="">
                                    {{$tag->title}}
                                </a>
                            </span>
                        @endforeach
                    </p>
                </div>

                <!--section comments-->
                @if (Auth::check())
                    @livewire('question', ['model' => $post], key('post-' . $post->id))
                @else
                    <div class="mt-4">
                        <h3 class="text-2xl font-semibold font-kumb">
                            Comentarios
                        </h3>
                        <p class="mt-2">
                            Registrate o haz login para escribir tu primer comentario
                        </p>
                        <p class="mt-3">
                            <span>
                                <a class="btn btn-purple" href="{{route('register')}}">Resgistrarse</a>
                            </span>
                            <span>
                                <a class="btn btn-purple" href="{{route('login')}}">Login</a>
                            </span>
                        </p>
                    </div>
                @endif
          
            </div>

            <!--aside or widget column-->
            <div class="col-span-8 lg:col-span-3">
                <div class="bg-gray-50 px-5 py-5 rounded-lg">
                    <div class="flex">
                        <div class="grid grid-cols-4 gap-4">
                            <div class="col-span-4">
                                <h3 class="font-kumb font-semibold text-2xl">
                                    Publicaciones Relacionadas
                                </h3>
                                <hr class="my-3">
                            </div>
                            @foreach ($related_posts as $post)
                                <div class="col-span-1">
                                    <a href="{{route('posts.show', $post)}}">
                                        <figure>
                                            {{-- <img class="w-full" src="{{$post->image}}" alt=""> --}}
                                            <img class="w-full" src="{{Storage::url($post->image_path)}}" alt="">
                                        </figure>
                                    </a>
                                </div>
                                <div class="col-span-3">
                                    <a href="{{route('posts.show', $post)}}" class="hover:text-indigo-600">
                                        <h3 class="font-kumb font-semibold">
                                            {{$post->title}}
                                        </h3>
                                    </a>
                                    <p class="text-gray-600 text-sm mt-1">
                                        {{$post->created_at->format('d/m/Y')}}
                                    </p>
                                </div>
                                <div class="col-span-4">
                                    <hr>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </x-container>

    @push('js')
        <script src="{{asset('vendor/prism.js/prism.js')}}"></script>
    @endpush

    <style>
        .style-text-ckeditor p span{
            color: white !important;
        }
    </style>
</x-app-layout>
