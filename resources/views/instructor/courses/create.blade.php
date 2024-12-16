<x-instructor-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear nuevo curso
        </h2>
    </x-slot>

    <x-container class="mt-12" width="4xl">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <form action="{{route('instructor.courses.store')}}" method="post">
                @csrf

                <h2 class="text-2xl uppercase text-center mb-4">
                    Complete esta información para crear el curso
                </h2>

                <x-validation-errors class="mb-4"></x-validation-errors>

                <div class="mb-4">
                    <x-label>Nombre del curso</x-label>
                    <x-input type="text" class="w-full" placeholder="Nombre del curso" name="title" 
                        value="{{old('title')}}" 
                        oninput="string_to_slug(this.value, '#slug')">
                    </x-input>
                </div>

                <div class="mb-4">
                    <x-label>Slug</x-label>
                    <x-input type="text" class="w-full" placeholder="Slug del curso" name="slug" id="slug" value="{{old('slug')}}"></x-input>
                </div>

                <div class="grid md:grid-cols-3 gap-4">
                    <div>
                        <x-label>Categorias</x-label>
                        <x-select name="category_id" id="category_id" class="w-full">
                            <option value="">Seleccione una categoria</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}" 
                                    @selected(old('category_id')  == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </x-select>
                    </div>
                    
                    <div>
                        <x-label>Niveles</x-label>
                        <x-select name="level_id" id="level_id" class="w-full">
                            @foreach ($levels as $level)
                                <option value="{{$level->id}}" 
                                    @selected(old('level_id')  == $level->id)>
                                    {{ $level->name }}
                                </option>
                            @endforeach
                        </x-select>
                    </div>
                    <div>
                        <x-label>Precios</x-label>
                        <x-select name="price_id" id="price_id" class="w-full">
                            @foreach ($prices as $price)
                                <option value="{{$price->id}}" 
                                    @selected(old('price_id')  == $price->id)>

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

                <div class="mt-4 flex justify-end">
                    <x-button>Crear curso</x-button>
                </div>

            </form>
        </div>
    </x-container>
    <script>
        document.getElementById('category_id').addEventListener('change', function() {
            const selectedCategoryId = this.value;

            const token = document.head.querySelector('meta[name="csrf-token"]').content;

             // Enviar el ID a la ruta utilizando Fetch API
            fetch(`/instructor/courses/${selectedCategoryId}/selected`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token
                },
            })
            .then(response => response.json())
            .then(data => {
                // Manejar la respuesta del servidor
                //console.log(data);
                const objeto = document.getElementById('checkSubcategories');
                objeto.innerHTML = '';

                if(data.length == 0){
                    //console.log(11111)
                    objeto.innerHTML = '<p>No hay subcategorias</p>';
                }

                data.forEach(function(elemento, indice) {
                    
                    //console.log(elemento.id)
                    let html = `
                        <label class="px-2">
                            <x-input type="checkbox" name="subcategories[]" value="${elemento.id}"/>
                            ${elemento.name}
                        </label>
                    `;
     
                    if(data.length > 1){
                        objeto.innerHTML += html;
                    }else{
                        objeto.innerHTML = html;
                    }

                });
            })
            .catch(error => {
                console.error('Error:', error);
            });
  
      
        });
      </script>
</x-instructor-layout>