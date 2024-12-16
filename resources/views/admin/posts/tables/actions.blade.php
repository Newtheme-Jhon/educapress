<div class="flex space-x-1" x-data="{
    page: 'posts',
    sweetalert(){
        let page = this.page;
        let item = 'post';
        let form = $refs.formDeletePost;
        alertConfirmation(form, page, item)
    }
}">
    
    <a class="btn btn-purple" href="{{route('admin.posts.edit', ['post' => \App\Models\Post::find($id) ])}}">
        <i class="fas fa-edit"></i>
    </a>

    <form class="hidden" x-ref="formDeletePost" action="{{route('admin.posts.destroy', ['post' => \App\Models\Post::find($id) ])}}" method="POST">
        @csrf
        @method('DELETE')
    </form>

    <button x-on:click="sweetalert()" type="submit" class="btn btn-red cursor-pointer">
        <i class="fas fa-trash-alt"></i>
    </button>

</div>

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('vendor/functionsjs/admin-ajax-delete.js')}}"></script>
@endpush
