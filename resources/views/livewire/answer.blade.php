<div class="pl-16">
    <div class="mt-1">
        <button wire:click="$set('answer_created.open', true)">
            <span><i class="fas fa-reply-all"></i></span>
            Responder
        </button>
    </div>
    
    @if ($answer_created['open'])

        <div class="flex">
            <figure class="mr-4">
                <img class="w-12 object-cover object-center rounded-full" src="{{$question->user->profile_photo_url}}" alt="imagen de perfil">
            </figure>
            <div class="flex-1">
                <form wire:submit="store()">

                    @if ($model->platform)
                        <x-comment-answer wire:model="answer_created.body"/>
                    @else
                        <textarea wire:model="answer_created.body" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Escriba su respuesta"></textarea>
                    @endif
                    
                    <x-input-error for="answer_created.body"></x-input-error>
                    <div class="flex justify-end">
                        <x-danger-button class="mr-2" wire:click="$set('answer_created.open', false)">
                            Cancelar
                        </x-danger-button>
                        <x-button>
                            Responder
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
        
    @endif

    @if ($question->answers()->count())
        
        <button class="mt-2 fony-semibold text-blue-500" wire:click="showAnswer()">
            @if ($open)
                Ocultar respuestas
            @else
                Mostrar respuestas
            @endif
        </button>

    @endif

    <ul class="space-y-6 mt-4">
        @foreach ($this->answers as $answer)
            <li wire:key="answer-{{$answer->id}}">

                <div class="flex">
                    <figure class="mr-4">
                        <img class="w-12 object-cover object-center rounded-full" src="{{$answer->user->profile_photo_url}}" alt="imagen de perfil">
                    </figure>
                    <div class="flex-1">
                        <p class="font-semibold">
                            {{$answer->user->name}} 
                            <span class="text-sm font-normal text-gray-500">
                                {{$answer->created_at->diffForHumans()}}
                            </span>
                        </p>
                        @if ($answer->id == $answer_edit['id'])

                            <form wire:submit="update({{$answer->id}})">

                                @if ($model->platform)
                                    <x-comment-answer-edit wire:model="answer_edit.body" />
                                @else
                                    <textarea wire:model="answer_edit.body" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
                                @endif
                                
                                <x-input-error for="answer_edit.body"></x-input-error>
                                <div class="flex justify-end">
                                    <x-danger-button class="mr-2" wire:click="cancel()">Cancelar</x-danger-button>
                                    <x-button>Actualizar</x-button>
                                </div>
                            </form>
                           
                        @else
                            @if ($model->platform)
                                {!!$answer->body!!}
                            @else
                                <p>
                                    {{$answer->body}}
                                </p>
                            @endif
                            
                        @endif

                        
                        <button wire:click="$set('answer_to_answer.id', {{$answer->id}})">
                            <span><i class="fas fa-reply-all"></i></span>
                            Responder
                        </button>
                       
                    </div>

                    <div class="flex w-8 justify-center" x-data="
                        {
                            open: false,
                            authUser: {{Auth::user()->id}},
                            answerUser: {{$answer->user_id}}
                        }
                    " x-init="
                        function init(){
                            if(this.authUser === this.answerUser){
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
                                    <x-dropdown-link class="cursor-pointer" wire:click="edit({{$answer->id}})">Editar</x-dropdown-link>
                                    <x-dropdown-link class="cursor-pointer" wire:click="destroy({{$answer->id}})">Eliminar</x-dropdown-link>
                                @endslot
                            </x-dropdown>
                        </div>
                    </div>

                </div>
                
                <!--response to response-->
                @if ($answer_to_answer['id'] == $answer->id)
                    <div class="flex mt-4">
                        <figure class="mr-4">
                            <img class="w-12 object-cover object-center rounded-full" src="{{$answer->user->profile_photo_url}}" alt="imagen de perfil">
                        </figure>
                        <div class="flex-1">
                            <form wire:submit="answer_to_answer_store()">
                                @if ($model->platform)
                                    <x-comment-answer-to-answer wire:model="aswer_to_answer.body" />
                                @else
                                    <textarea wire:model="answer_to_answer.body" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Escriba una respuesta"></textarea>
                                @endif
                               
                                <div class="flex justify-end">
                                    <x-danger-button class="mr-2" wire:click="$set('answer_to_answer.id', null)">
                                        Cancelar
                                    </x-danger-button>
                                    <x-button>Responder</x-button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif

            </li>
        @endforeach
    </ul>
</div>

@assets
<!--prism.js-->
<link rel="stylesheet" href="{{asset('vendor/prism.js/prism.css')}}">
<script src="{{asset('vendor/prism.js/prism.js')}}"></script>
@endassets

@script
<script>

    /** 
     * Este evento se dispara en el metodo showAnswer() del componente Answer
     * esta funcion se ejecutara pasado un segundo, asi dara tiempo a que se cargue el DOM
     * Asi podra aplicar los estilos del prismjs al mostrar las respuestas ocultas
     * **/
    Livewire.on('show-prism-answer', function(){
        setTimeout(function(){
            Prism.highlightAll();
        }, 1000);
    })
    
</script>
@endscript