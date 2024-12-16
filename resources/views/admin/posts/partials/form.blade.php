

{{-- @dd($category) --}}
<!--title-->
<div class="mb-4">
    <x-label class="w-full mb-1 font-semibold">Titulo</x-label>
    @if ($routeName == 'admin.posts.edit')
        <x-input type="text" class="w-full" name="title" id="title" value="{{$post->title}}"></x-input>
    @else
        <x-input type="text" class="w-full" name="title" id="title"/>
    @endif
    
    @error('title')
        <small class="text-red-600">{{$message}}</small>
    @enderror
</div>

<!--slug-->
<div class="mb-4">
    <x-label class="w-full mb-1 font-semibold">Slug</x-label>
    @if ($routeName == 'admin.posts.edit')
        <x-input type="text" class="w-full text-gray-600" name="slug" id="slug" value="{{$post->slug}}"></x-input>
    @else
        <x-input type="text" class="w-full text-gray-600" name="slug" id="slug" readonly />
    @endif
    
    @error('slug')
        <small class="text-red-600">{{$message}}</small>
    @enderror
</div>

<!--Categories-->
<div class="mb-4">
    <x-label class="w-full mb-1 font-semibold">Categoría</x-label>
    <x-select name="post_category_id" class="">

        @foreach ($category as $key => $item)
            @if ($routeName == 'admin.posts.edit')
                <option value="{{$key}}" @if($post->post_category_id == $key) selected="selected" @endif>{{$item}}</option>
            @else
                <option value="{{$key}}">{{$item}}</option>
            @endif
            
        @endforeach
        
    </x-select>
    @error('post_category_id')
        <small class="text-red-600">{{$message}}</small>
    @enderror
</div>

<!--Tags-->
<div class="mb-4">
    <x-label class="w-full mb-2 font-semibold">Etiquetas</x-label>
    <hr>
    <div class="flex flex-wrap justify-init items-center space-x-4 mt-2">
        {{-- @dump($tag_id) --}}
        @foreach ($tags as $key => $item)

            <div>
                @if ($routeName == 'admin.posts.edit')
                    <input 
                        type="checkbox" 
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                        name="tags[]" {{in_array($key, $tag_id) ? 'checked' : ''}} 
                        id="tag" 
                        value="{{$key}}" >
                @else
                    <x-input type="checkbox" class="" name="tags[]" id="tag" value="{{$key}}" />
                @endif
                
                <label class="inline">{{$item}}</label>
            </div>

        @endforeach
    </div>

    @error('tags')
        <small class="text-red-600">{{$message}}</small>
    @enderror
</div>

<!--status-->
<div class="mb-4">
    <x-label class="mb-2 font-semibold">Estado</x-label>
    <hr>
    <div class="form-check mt-2">
        
        @if ($routeName == 'admin.posts.edit')
            <input type="radio" class="form-check-input" name="status" id="status" value="1" {{$post->status->value == 1 ? 'checked' : ''}} >
        @else
            <input type="radio" class="form-check-input" name="status" id="status" value="1" >
        @endif
        <label for="radio1" class="form-check-label">Borrador</label>

    </div>
    <div class="form-check">
        
        @if ($routeName == 'admin.posts.edit')
            <input type="radio" class="form-check-input" name="status" id="status" value="2" {{$post->status->value == 2 ? 'checked' : ''}}>
        @else
            <input type="radio" class="form-check-input" name="status" id="status" value="2">
        @endif
        <label for="radio2" class="form-check-label">Publicado</label>
    </div>
    @error('status')
        <small class="text-red-600">{{$message}}</small>
    @enderror
</div>

<div><hr class="mb-3"></div>

<!--image-->
<div class="post-thumnail grid grid-cols-6 gap-8 mb-4">
    <div class="col-span-6 lg:col-span-4">
        @if ($routeName == 'admin.posts.edit')
            @if ($post->image_path)
                <img src="{{Storage::url($post->image_path)}}" alt="post-thumbnail" class="img-fluid" id="image">
            @else
                <img src="{{asset('img/no-image.jpg')}}" alt="post-thumbnail" class="img-fluid" id="image">
            @endif
        @else
            <figure>
                <img src="{{asset('img/no-image.jpg')}}" alt="post-thumbnail" class="w-full object-cover" id="image">
            </figure>
        @endif
        
    </div>
    <div class="col-span-6 lg:col-span-2">
        <h3 class="text-2xl font-semibold">Subir imagen del Post</h3>
        <div class="mb-3 mt-3">
            
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload file</label>
            <input 
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" 
                aria-describedby="file_input_help" 
                name="image_path" 
                id="postImage" 
                type="file" 
                accept="image/*"
            >
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF (MAX. 800x400px).</p>

            {{-- <input type="file" id="postImage" name="image_path" accept="image/*" /> --}}
            <p class="mt-3">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem unde error nisi aut soluta voluptatem! 
                Totam qui debitis reiciendis.
            </p>
        </div>
        @error('image_path')
            <small class="text-red-600">{{$message}}</small>
        @enderror
    </div>
</div>

<div><hr class="mb-4"></div>

<!--extract-->
<div class="mb-3 mt-4">
    <x-label class="w-full mb-1 font-semibold">Extract</x-label>
    <p class="mb-4">
        <span><i class="fas fa-info-circle text-indigo-500 pr-2"></i></span>
        <span>Aquí solo podrá escribir texto</span>
    </p>
    <x-textarea name="excerpt" id="excerpt" rows="5" class="w-full">
        @if ($routeName == 'admin.posts.edit')
            {{( isset($post->excerpt) ? $post->excerpt : '' )}}
        @endif
    </x-textarea>
    @error('excerpt')
        <small class="text-red-600">{{$message}}</small>
    @enderror
</div>

<div><hr class="mb-4"></div>

<!--content-->
<div class="mb-3">
    <x-label class="w-full mb-1 font-semibold">Contenido</x-label>
    <p class="mb-4">
        <span><i class="fas fa-info-circle text-indigo-500 pr-2"></i></span>
        <span>Aquí podrá escribir texto y subir imagenes</span>
    </p>
    <x-textarea name="content" id="content" rows="5" class="w-full">
        @if ($routeName == 'admin.posts.edit')
            {{( isset($post->content) ? $post->content : '' )}}
        @endif
    </x-textarea>
    @error('content')
        <small class="text-red-600">{{$message}}</small>
    @enderror
</div>
