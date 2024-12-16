<form method="POST" action="{{route('instructor.courses.update', $course)}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <p class="text-2xl font-semibold">
        Información del curso
    </p>
    <hr class="mt-2 mb-6">

    <x-validation-errors class="mb-4"></x-validation-errors>

    <div class="mb-4">
        <x-label class="mb-1">Título del curso</x-label>
        <x-input type="text" class="w-full" value="{{old('title', $course->title)}}" name="title" id="title"></x-input>
    </div>

    @empty($course->published_at) 
        <div class="mb-4">
            <x-label class="mb-1">Slug del curso</x-label>
            <x-input type="text" class="w-full" value="{{old('slug', $course->slug)}}" name="slug" id="slug"></x-input>
        </div>
    @endempty

    <div class="mb-4">
        <x-label class="mb-1">Resumen del curso</x-label>
        <x-textarea class="w-full" name="summary" id="editCourseResum">
            {{old('summary', $course->summary)}}
        </x-textarea>
    </div>

    <div class="mb-4 ckeditor">
        <x-label class="mb-1">Descripción del curso</x-label>
        <x-textarea class="w-full" name="description" id="editCourseDescription">
            {{old('description', $course->description)}}
        </x-textarea>
    </div>

    <div class="grid md:grid-cols-3 gap-4 mb-8">
        <!--categories-->
        <div>
            <x-label>Categorias</x-label>
            <x-select name="category_id" id="category_id" class="w-full">
                <option value="">Selecciona categoria</option>
                @foreach ($categories as $category)
                
                    <option value="{{$category->id}}" 
                        @selected(old('category_id', $course->category_id)  == $category->id)>
                        {{ $category->name }}
                    </option>
                    <script>
                        //selectedCategoryId = {{$course->category_id}}
                    </script>

                @endforeach
            </x-select>
        </div>
        <!--levels-->
        <div>
            <x-label>Niveles</x-label>
            <x-select name="level_id" id="level_id" class="w-full">
                @foreach ($levels as $level)
                    <option value="{{$level->id}}" 
                        @selected(old('level_id', $course->level_id)  == $level->id)>
                        {{ $level->name }}
                    </option>
                @endforeach
            </x-select>
        </div>
        <!--prices-->
        <div>
            <x-label>Precios</x-label>
            <x-select name="price_id" id="price_id" class="w-full">
                @foreach ($prices as $price)
                    <option value="{{$price->id}}" 
                        @selected(old('price_id', $course->price_id)  == $price->id)>

                        @if ($price->value == 0)
                            Gratis
                        @else
                        {{ $price->value }} US$ (Nivel {{$loop->index}})
                        @endif
                        
                    </option>
                @endforeach
            </x-select>
        </div>

        <div class="col-span-2 pb-2">
            <x-label class="font-semibold pb-2">Subcategorias</x-label>
            <div id="checkSubcategories"></div>
        </div>
    </div>

    <div>
        <p class="text-2xl font-semibold mb-2">Imagen del curso</p>
        <div class="grid md:grid-cols-2 gap-4">
            <figure>
                <img id="imgPreview" class="w-full aspect-video object-cover" src="{{$course->image}}" alt="">
            </figure>
            <div>
                <p class="mb-3">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum, officiis rem dolore incidunt nesciunt soluta aut voluptatum optio illo minima iure expedita ipsam totam sequi dolores ex impedit. Possimus, eligendi?
                </p>
                <label>
                    <span class="btn btn-blue md:hidden cursor-pointer">Selecciona una imagen</span>
                    <input class="hidden md:block" type="file" accept="image/*" name="image" onchange="preview_image(event, '#imgPreview')">
                </label>
                

                <div class="flex md:justify-end mt-4">
                    <x-button>Guardar cambios</x-button>
                </div>
            </div>
        </div>
    </div>
</form>