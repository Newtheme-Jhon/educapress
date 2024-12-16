<div class="flex space-x-1" x-data="{
    page: 'tags',
    sweetalert(){
        let page = this.page;
        let item = 'etiqueta';
        let form = $refs.formDeleteTag;
        alertConfirmation(form, page, item)
    }
}">
    
    <a class="btn btn-purple" href="{{route('admin.tags.edit', ['tag' => $id ])}}">
        <i class="fas fa-edit"></i>
    </a>

    <form x-ref="formDeleteTag" class="hidden" action="{{route('admin.tags.destroy', ['tag' => $id])}}" method="POST">
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