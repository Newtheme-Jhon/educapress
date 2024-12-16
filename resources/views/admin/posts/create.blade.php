<x-admin-layout :breadcrumb="[
    [
        'name' => 'Posts',
        'url' => '#'
    ], 
    [
        'name' => 'Crear Post',
    ]
]">


<div class="flex">
    <div class="flex-1">
        <h1 class="mb-3 text-2xl font-semibold">Crear Post</h1>
    </div>
</div>

@if (session('success'))
<div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
    <span class="font-medium">
        {{session('success')}}
    </span>
</div>
@endif


<!--mostrar posts-->
<div class="mt-4">

    <div class="grid grid-cols-6">
        <div class="col-span-6 lg:col-span-5">
            <form action="{{route('admin.posts.store')}}" method="post" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">

                @include('admin.posts.partials.form')

                <button class="btn btn-purple">Submit</button>
            </form>
        </div>
    </div>

</div>


@push('js')

<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>

<script src="{{asset('vendor/stringToSlug-1.3/jquery.stringToSlug.min.js')}}"></script>

<script>
    $(document).ready(function(){
        $('#title').stringToSlug({
            setEvents: 'keyup keydown blur',
            getPut: '#slug',
            space: '-'
        })
    })

    //Mostrar imagen del post
    document.getElementById('postImage').addEventListener('change', mostrarImagen);

    function mostrarImagen(e){
        let file = e.target.files[0];
        let reader = new FileReader();
        reader.onload = (e) =>{
            document.getElementById('image').setAttribute('src', e.target.result)
        };

        reader.readAsDataURL(file);
    }
</script>

@endpush

<style>

    /* altura del ckeditor */
    .ck-editor__editable_inline:not(.ck-comment__input *) {
        height: 300px;
        overflow-y: auto;
    }

    /* tamaño en el que se ven las imagenes */
    .ck.ck-editor__editable .image-inline img{
        width: 400px;
    }
    .ck-content .image img {
        width: 400px;
    }
    
</style>

</x-admin-layout>