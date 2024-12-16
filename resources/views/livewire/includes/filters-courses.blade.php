<div>
    <!--ordenar por-->
    <div class="mb-4">
        <p class="text-lg font-semibold">Ordenar por</p>
        <x-select>
            <option value="published_at">Más reciente</option>
            <option value="students_count">Más alumnos</option>
            <option value="rating">Mejor calificado</option>
        </x-select>
    </div>

    
    <!--filtrar por categorias-->
    <div class="mb-4" wire:ignore>
        <p class="text-lg font-semibold">Categorías</p>
        <x-select class="space-y-1" wire:model.live="selectedCategories">
            <option value="0">Selecciona tu categoría</option>
            @foreach ($categories as $category)
                <option value="{{$category->id}}">
                    {{$category->name}}
                </option>
            @endforeach
        </x-select>
    </div>

    <!--filtrar por niveles-->
    <div class="mb-4">
        <p class="text-lg font-semibold">Niveles</p>
        <ul class="space-y-1">
            @foreach ($levels as $level)
                <li>
                    <label>
                        <x-checkbox wire:model.live="selectedLevels" value="{{$level->id}}" />
                        {{$level->name}}
                    </label>
                </li>
            @endforeach
        </ul>
    </div>

    <!--filtrar por precios-->
    <div>
        <p class="text-lg font-semibold">Niveles</p>
        <ul class="space-y-1">
            <li>
                <label>
                    <x-checkbox wire:model.live="selectedPrices" value="free" />
                    Gratis
                </label>
            </li>
            <li>
                <label>
                    <x-checkbox wire:model.live="selectedPrices" value="premium" />
                    Premium
                </label>
            </li>
        </ul>
    </div>
</div>