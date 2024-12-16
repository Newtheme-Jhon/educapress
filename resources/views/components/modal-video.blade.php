@push('css')
<link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
@endpush

@props(['lesson'])

<div x-data="{
    player : '',
    init(){
        open = false
        this.player = new Plyr($refs.player)
    },
    cerrar(){
        open = !open
        this.player.stop()
        //console.log(this.player)
    }
}" >
    
  <!-- Main modal -->
  <div x-show="open = open" id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" {{$attributes->merge(['class' => 'flex overflow-y-auto overflow-x-hidden fixed top-0 z-50 justify-center items-center '])}}>
      <div class="relative p-4 w-full max-w-2xl max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 opacity-100">
              <!-- Modal header -->
              <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                  <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                      Lección: {{$lesson->name}}
                  </h3>
                  <button x-on:click="cerrar()" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                      <span class="sr-only">Close modal</span>
                  </button>
              </div>
              <!-- Modal body -->
              <div class="p-4 md:p-5 space-y-4">
                 <!--aqui el video-->
                 
                 @if ($lesson->platform == 1)
                    <div class="w-full" wire:key="{{$lesson->id}}" wire:ignore>
                        
                        <div>
                            <video x-ref="player" playsinline controls data-poster="{{env('AWS_CLOUDFRONT_URL') . '/' . $lesson->image_path}}" class="aspect-video">
                                {{-- <source src="{{Storage::disk('s3')->url($lesson->video_path)}}"> --}}
                                <source src="{{env('AWS_CLOUDFRONT_URL') . '/' . $lesson->video_path}}">
                            </video>
                        </div>
        
                    </div>
                     
                 @endif
                 
              </div>
              <!-- Modal footer -->
              <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                  <button x-on:click="cerrar()" data-modal-hide="static-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cerrar</button>
              </div>
          </div>
      </div>
      
  </div>

  <div x-show="open" x-on:click="cerrar()" class="bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40"></div>
</div>

@push('js')
<script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>

@endpush