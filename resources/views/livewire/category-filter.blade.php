<div>
    <x-container class="mt-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <aside class="col-span-1">
                @include('livewire.includes.filters-categories')
            </aside>
            <div class="col-span-3">
                {{-- @dump($category) --}}
                @if($courses->count() <= 0)

                    <div role="alert" class="mt-3 relative flex w-full p-3 text-sm text-white bg-slate-800 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5 mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"></path></svg>
                            De momento no tenemos ningún curso que coincida con su búsqueda
                        <button class="flex items-center justify-center transition-all w-8 h-8 rounded-md text-white hover:bg-white/10 active:bg-white/10 absolute top-1.5 right-1.5" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                    
                @else

                    <div class="grid gap-4 xl:grid-cols-2  md:grid-cols-2">
                        @foreach ($courses as $course)
                            <x-card-courses :course="$course" wire:key="course-{{$course->id}}"></x-card-courses>
                        @endforeach
                    </div>

                @endif

                 <!--paginate-->
                <div class="mt-4">
                    {{$courses->links()}}
                </div>
            </div>
        </div>
    </x-container>
</div>
