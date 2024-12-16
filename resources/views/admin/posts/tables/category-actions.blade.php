<div class="flex space-x-1" x-data="{
    page: 'post_categories',
    sweetalert(){
        let page = this.page;
        let item = 'categoria';
        let form = $refs.formDeletePostCategory;
        alertConfirmation(form, page, item)
    }
}">
    
    <a class="btn btn-purple" href="{{route('admin.post_categories.edit', ['post_category' => $id ])}}">
        <i class="fas fa-edit"></i>
    </a>

    <form x-ref="formDeletePostCategory" action="{{route('admin.post_categories.destroy', ['post_category' => $id])}}" method="POST">
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