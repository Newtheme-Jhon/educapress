<div>
    <div x-data="{destroySection(sectionId)
        { 
            return swallSectionConfirmation(sectionId)
            
        }
    }" x-init="orderSectionsSortable($refs.sections)">

        @if ($sections->count())
            
            <!--x-ref se utiliza en alpine es como si fuera el atributo id 
            https://alpinejs.dev/directives/ref -->
            <ul class="mb-6 space-y-6" x-ref="sections">
                @foreach ($sections as $section)

                    <!--list of sections-->
                    <li data-id="{{$section->id}}" wire:key="section-{{$section->id}}">
                        
                        <div x-data="{open:false}" class="mb-6">

                            @include('instructor.courses.sections.create-position')

                        </div>

                        <div class="bg-gray-100 rounded-lg shadow-lg px-6 py-4">

                            @if ($sectionEdit['id'] == $section->id)

                                @include('instructor.courses.sections.edit')

                            @else
                                @include('instructor.courses.sections.show')
                            @endif

                            <div class="mt-4">
                                <!--Añadimos esto a la llave para renderizar por segunda vez el componente-->
                                {{-- {{$orderLessons->join('-')}} --}}
                                @livewire('instructor.courses.manage-lessons', [
                                    'section'       => $section,
                                    'lessons'       => $section->lessons,
                                    'orderLessons'  => $orderLessons
                                    ], key('section-lessons-' . $section->id . '-' . $orderLessons->join('-')))
                            </div>

                        </div>
                    </li>

                @endforeach
            </ul>

        @endif

        @include('instructor.courses.sections.create')
    </div>

    @push('js')

        <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

        <script>

            function orderSectionsSortable(sections){

                const sortable = new Sortable(sections, {
                    animation: 150,
                    handle: '.handle',
                    ghostClass: 'blue-background-class',
                    store: {
                        set: function (sortable) {
                            const order = sortable.toArray();
                            //console.log(order);
                            @this.call('sortSections', order);
                        }
                    }
                })

            }

        </script>

        <script>
            function swallSectionConfirmation(id){
                Swal.fire({
                    title: "Estas seguro?",
                    text: "No podras revertir esta acción!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "si, eliminarlo!",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Eliminado!",
                            text: "La sección ha sido eliminada.",
                            icon: "success"
                        });

                        @this.call('destroy', id);
                    }
                });
            }
        </script>
    @endpush

</div>