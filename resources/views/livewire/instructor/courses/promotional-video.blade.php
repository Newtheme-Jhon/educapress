
<div>
    @push('css')
        <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    @endpush

    <h1 class="text-2xl font-semibold">Video promocional</h1>
    <hr class="mt-2 mb-6">
    <div class="grid grid-cols-2 gap-6">
        <div class="col-span-1">
            @if ($course->video_path)

                <!--Reproductor: https://plyr.io/ -->
                <div wire:ignore>
                    <div x-data x-init="
                        let player = new Plyr($refs.player);
                    ">
                        <video x-ref="player" playsinline controls data-poster="{{$course->image}}" class="aspect-video">
                            {{-- <source src="{{Storage::disk('s3')->url($course->video_path)}}"> --}}
                                <source src="{{env('AWS_CLOUDFRONT_URL') . '/' . $course->video_path}}">
                        </video>
                    </div>
                </div>

            @else
                <figure>
                    <img src="{{$course->image}}" class="w-full aspect-video object-cover">
                </figure>
            @endif
        </div>
        <div class="col-span-1">
            <p class="mb-4">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas cumque facere et eligendi hic aspernatur. 
                Qui maxime in aperiam dolores libero consequuntur magni optio aliquid doloribus dolor! Sapiente, ratione corporis.
            </p>

            <form wire:submit="save">
                <x-validation-errors></x-validation-errors>
                <x-progress-indicator wire:model="video"></x-progress-indicator>

                <div class="flex justify-end mt-4">
                    <x-button>
                        Subir video
                    </x-button>
                </div>
            </form>
        </div>
    </div>
    @push('js')
        <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
        {{-- <script>
            const player = new Plyr('#player');
        </script> --}}
    @endpush
</div>

