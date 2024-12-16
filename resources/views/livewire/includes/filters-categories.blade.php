<div>
    <!--ordenar por-->
    {{-- <div class="mb-4">
        <p class="text-lg font-semibold">Ordenar por</p>
        <x-select>
            <option value="published_at">Más reciente</option>
            <option value="students_count">Más alumnos</option>
            <option value="rating">Mejor calificado</option>
        </x-select>
    </div> --}}

    
    <!--filtrar por categorias-->
    <div class="mb-4" wire:ignore>
        <p class="text-lg font-semibold">Subcategorías</p>
        <x-select class="space-y-1" wire:model.live="selectedSubcategories">
            <option value="0">Selecciona tu subcategoría</option>
            @foreach ($subcategories as $subcategory)
                <option value="{{$subcategory->id}}">
                    {{$subcategory->name}}
                </option>
            @endforeach
        </x-select>
    </div>

</div>