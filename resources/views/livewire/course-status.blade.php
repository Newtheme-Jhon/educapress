<div>

    @push('css')
        <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    @endpush

    <x-container>
        <!--video-->
        <div class="grid cols-1 pt-4">
            <div class="embed-responsive">
                @if ($current->platform == 2)
                
                    <iframe  
                        src="https://www.youtube.com/embed/{{$current->video_path}}" 
                        title="YouTube video player" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        referrerpolicy="strict-origin-when-cross-origin" 
                        allowfullscreen>
                    </iframe>
                
                @else

                <div wire:ignore class="top-0 absolute w-full" wire:key="{{$current->id}}">
                    <div x-data="{
                        next: {{$this->next}}
                    }" x-init="
                        function init(){
                            let player = new Plyr($refs.player);

                            //se dispara al finalizar el video
                            player.on('ended', () => {
                                @this.dispatch('video-ended', [this.next]);
                            });
                        }
                    ">
                        <video x-ref="player" playsinline controls data-poster="{{$course->image}}" class="aspect-video">
                            {{-- <source src="{{Storage::disk('s3')->url($current->video_path)}}"> --}}
                            <source src="{{env('AWS_CLOUDFRONT_URL') . '/' . $current->video_path}}">
                        </video>
                    </div>
                </div>
                    
                @endif
            </div>
            
            <div class="mt-4">
                <p class="text-lg sm:text-2xl">
                    <span class="font-semibold">Leccion {{$this->index}}:</span>
                    <span class="">{{$current->name}}</span>
                </p>
                <div class="grid grid-cols-2 gap-6 mt-4">
                    <div class="col-span-2 sm:col-span-1 space-x-2 flex items-center mt-1 cursor-pointer" wire:click="buttonCompletedLesson()">
                        @if ($current->lessonCompleted)
                            <button>
                                <span><i class="fas fa-toggle-on text-lg sm:text-2xl text-indigo-500"></i></span>
                            </button>
                        @else
                            <button>
                                <span><i class="fas fa-toggle-off text-lg sm:text-2xl"></i></span>
                            </button>                
                        @endif

                        <span class="text-lg sm:text-2xl">Marcar como finalizado</span> 
                    </div>

                    <div class="col-span-2 sm:col-span-1 flex sm:justify-end">
                        @if ($current->resource)
                            <p class="cursor-pointer" wire:click="download()">
                                <span class="pr-3 font-semibold">Descargar recurso</span>
                                <span><i class="fa-solid fa-cloud-arrow-down text-indigo-500 text-2xl"></i></span>
                            </p>
                        @endif
                    </div>
                </div>

                <div class="flex bg-white rounded-lg shadow-lg mt-4 p-4 text-1xl font-semibold">
                    @if ($this->previous)
                        <button wire:click="changeLesson({{$this->previous}})">
                            <span><i class="fa-solid fa-backward-fast"></i></span>
                            Tema anterior
                        </button>
                    @endif
                    
                    @if ($this->next)
                        <button wire:click="changeLesson({{$this->next}})" class="ml-auto">
                            Siguiente tema
                            <span><i class="fa-solid fa-forward-fast"></i></span>
                        </button>
                    @endif
                </div>

                <div class="flex mt-4" x-cloak>
                    @include('livewire.includes.modal-review')
                </div>

            </div>
        </div>

        {{-- @dump($currentUrl) --}}

        <!--comentarios y control de clases lib comments-->
        <div class="grid lg:grid-cols-9 gap-6 mt-8" x-data="{open: false}">

            <!--comentarios lecciones-->
            <div class="col-span-9 md:col-span-9 lg:col-span-4 bg-gray-50 rounded-lg order-2 lg:order-1 px-4 py-4 overflow-auto">
                @livewire('question', ['model' => $current], key('lesson-question' . $current->id))
            </div>

            <!--temario curso-->
            <div class="col-span-9 md:col-span-6 lg:col-span-5 bg-gray-200">
                @include('livewire.includes.temario-status-course')
            </div>
        </div>
        
    </x-container>

    @push('js')
        <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
    @endpush

</div>
@script
<script>
    Livewire.on('lesson-changed-url', (url) => {
        //console.log(url)
        window.history.pushState({}, '', `${url}`);
    });
</script>
@endscript