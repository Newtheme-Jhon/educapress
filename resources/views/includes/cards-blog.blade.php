<x-container>
    <div class="mt-8">
        <h1 class="text-4xl font-kumb text-left">
            Nuestro blog
        </h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 pt-4" >

        @foreach ($posts as $post)
        
        <div class="border border-slate-300 rounded-2xl">
            <a href="{{route('posts.show', $post)}}">
                <div class="bg-cover h-52 mb-1 rounded-t-lg" style="background-image: url({{Storage::url($post->image_path)}});"></div>
                <div class="p-3">
                    <h3 class="text-2xl mb-2">
                        {{substr($post->title, 0, 40)}}...
                    </h3>
                    <p>
                        {{$post->created_at->format('d/m/Y')}}
                    </p>
                    
                </div>
            </a>
        </div>

        @endforeach

    </div>
</x-container>