<x-admin-layout :breadcrumb="[
    [
        'name' => 'Observaciones del curso',
        'url' => '#'
    ], 
    [
        'name' => 'Observaciones',
    ]
]">


<div class="flex">
    <div class="flex-1">
        <h1 class="mb-3 text-2xl font-semibold">Observaciones del curso: {{$course->title}}</h1>
    </div>
</div>

{{-- @if (session('success'))
<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
    <span class="font-medium">
        {{session('success')}}
    </span>
</div>
@endif --}}


<div class="grid grid-cols-2">
    <div class="col-span-2">
        <div class="card bg-gray-100">
            <form action="{{route('admin.courses.reject', $course)}}" method="POST">
                @csrf
                <div>
                    <x-label class="mb-2 font-semibold text-1xl">Escribir observaciones</x-label>
                    <x-textarea class="w-full" name="content" id="ckeditor"></x-textarea>
                    <x-input-error for="content" class="mt-1"></x-input-error>
                </div>
                <div class="mt-2">
                    <x-button>Rechazar</x-button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')

    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
        .create(document.querySelector('#ckeditor'))
        .catch(error => {

        })
    </script>

@endpush

<style>

    .ck-editor__editable_inline:not(.ck-comment__input *) {
        height: 200px;
        overflow-y: auto;
    }

</style>

</x-admin-layout>