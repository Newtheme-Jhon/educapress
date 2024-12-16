<x-instructor-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Curso: {{$course->title}}
        </h2>
    </x-slot>

    <x-container class="py-8">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
            <aside class="col-span-1">
                <nav>
                    @include('instructor.courses.includes.menu-table')
                </nav>
            </aside>
            <div class="col-span-1 lg:col-span-4">
                <div class="card">
                    @include('instructor.courses.includes.form-edit')
                </div>
            </div>
        </div>
    </x-container>

@php
        
    $subc = [];
    foreach ($course->subcategories as $sub) {
        array_push($subc, $sub->pivot->subcategory_id);
    }

    
    //dump(json_encode($subc))

@endphp

@push('js')

<!--ckeditor se maneja desde: resource/js/assets/ckeditor.js-->

<script>

    window.addEventListener('load', function(){
        let selectedCategoryId = {{$course->category_id}};

        subcategoryChange(selectedCategoryId);

        document.getElementById('category_id').addEventListener('change', function() {
            selectedCategoryId = this.value;
            subcategoryChange(selectedCategoryId);
        });
    })

    function subcategoryChange(selectedCategoryId){

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
            let nums = {{json_encode($subc)}}

            const objeto = document.getElementById('checkSubcategories');
            objeto.innerHTML = '';

            if(data.length == 0){
                objeto.innerHTML = '<p>No hay subcategorias</p>';
            }

            data.forEach(function(elemento, indice) {

                let html = `
                        <label class="px-2">
                            <x-input type="checkbox" id="check${elemento.id}" name="subcategories[]" value="${elemento.id}"/>
                            ${elemento.name}
                        </label>
                    `;

                if(data.length > 1){
                    objeto.innerHTML += html;
                   
                }else if(data.length == 1){
                    objeto.innerHTML = html;
                }

                let checked = false;

                if(nums.includes(elemento.id)){

                    checked = true;
                    //console.log(elemento.id)
                    const ele = document.getElementById(`check${elemento.id}`);
                    ele.setAttribute('checked', '');
                    
                }
                
            });

        })
        .catch(error => {
            console.error('Error:', error);
        });

    }

  </script>

@endpush

<style>

    .ck-editor__editable_inline:not(.ck-comment__input *) {
        height: 200px;
        overflow-y: auto;
    }
    
</style>
    
</x-instructor-layout>