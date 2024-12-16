
<div> 
    <div class="flex mt-8">
        <figure class="mr-4">
            <img class="w-12 object-cover object-center rounded-full" src="{{Auth::user()->profile_photo_url}}" alt="foto de perfil">
        </figure>
        <div class="flex-1">

            <!--si es modelo lesson caja de comentarios con ckeditor5-->
            <form wire:submit="store">

                @if ($model->platform)
                    <x-comment-question wire:model="message"/>
                @else
                    <textarea wire:model="message" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Escribe tu comentario"></textarea>
                @endif
                <x-input-error for="message"></x-input-error>
                
                <div class="flex justify-end">
                    <x-button class="mt-4">comentar</x-button>
                </div>
                
            </form>
            
        </div>
    </div>

    <div class="mt-4">
        <p>Comentarios:</p>
        <ul class="mt-4 space-y-6">
            {{-- @dd($questions) --}}
            @foreach ($this->questions as $question)
                <li wire:key="question-{{$question->id}}">
                    <div class="flex">
                        <figure class="mr-4">
                            <img class="w-12 object-cover object-center rounded-full" src="{{$question->user->profile_photo_url}}" alt="imagen de perfil">
                        </figure>

                        <div class="flex-1">

                            <p class="font-semibold">
                                {{$question->user->name}} 
                                <span class="text-sm font-normal text-gray-500">
                                    {{$question->created_at->diffForHumans()}}
                                </span>
                            </p>
                                
                            @if ($question->id == $question_edit['id'])
                                
                                <form wire:submit="update()">

                                    @if ($model->platform)
                                        <!--este es para las lecciones del curso-->
                                        <x-comment-edit wire:model="question_edit.body" />
                                    @else
                                        <!--este es para los post-->
                                        <textarea wire:model="question_edit.body" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
                                    @endif

                                    <x-input-error for="question_edit.body"></x-input-error>
                                    <div class="flex justify-end">
                                        <x-danger-button class="mr-2" wire:click="cancel()">Cancelar</x-danger-button>
                                        <x-button>Actualizar</x-button>
                                    </div>
                                </form>

                            @else
                                <div wire:ignore>
                                    @if ($model->platform)
                                        {!!$question->body!!}
                                    @else
                                        <p>
                                            {{$question->body}}
                                        </p>
                                    @endif
                                </div>
                            @endif
                            {{-- @dump($question->user->id) --}}
                        </div>

                        <div class="flex w-8 justify-center" x-data="{
                                open: false,
                                authUser: {{Auth::user()->id}},
                                questionUser: {{$question->user->id}}
                            }" 
                            x-init="
                            function init(){
                                //console.log(this.open);
                                if(this.questionUser === this.authUser){
                                    this.open = true
                                }
                            }
                        ">
                            <div x-show="open">
                                <x-dropdown>
                                    @slot('trigger')
                                        <button class="w-8">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                    @endslot

                                    @slot('content')
                                        <x-dropdown-link class="cursor-pointer" wire:click="edit({{$question->id}})">Editar</x-dropdown-link>
                                        <x-dropdown-link class="cursor-pointer" wire:click="destroy({{$question->id}})">Eliminar</x-dropdown-link>
                                    @endslot
                                </x-dropdown> 
                            </div>
                        </div>
                    </div>
                    @livewire(
                        'answer', 
                        compact('question', 'model'),
                        key('answer-' . $question->id . 'user-' . Auth::user()->id))
                </li>
            @endforeach
        </ul>

        @if ($model->questions()->count() - $quantity > 0)
            <div class="flex items-center">
                <hr class="flex-1">
                <button class="text-sm font-semibold text-gray-500 mx-4 hover:text-gray-700" wire:click="showMoreQuestion()">
                    Ver  los {{$model->questions()->count() - $quantity}} comentarios restantes
                </button>
                <hr class="flex-1">
            </div>
        @endif 
    </div>
</div>
@assets
<!--prism.js-->
<link rel="stylesheet" href="{{asset('vendor/prism.js/prism.css')}}">
<script src="{{asset('vendor/prism.js/prism.js')}}"></script>
@endassets

@script
<script>

    /** 
     * Este evento se dispara en el metodo showMoreQuestion() del componente Question
     * esta funcion se ejecutara pasado un segundo, asi dara tiempo a que se cargue el DOM
     * Asi podra aplicar los estilos del prismjs al mostrar los cometarios ocultos
     * **/
    Livewire.on('show-prism', function(){
        setTimeout(function(){
            Prism.highlightAll();
        }, 1000);
    })
    
    
</script>
@endscript