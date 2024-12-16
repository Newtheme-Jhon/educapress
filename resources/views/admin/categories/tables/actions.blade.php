<div class="flex space-x-1" x-data="{
    page: 'categories',
    sweetalert(){
        let page = this.page;
        let item = 'categoria';
        let form = $refs.formDeleteCategory;

        //esta función esta en: resources/assets/js/
        alertConfirmation(form, page, item)
    }
}">
    
    <a class="btn btn-green" href="{{route('admin.categories.edit', [
        'category' => \App\Models\Category::find($id)
    ])}}">Editar</a>

    <form x-ref="formDeleteCategory" action="{{route('admin.categories.destroy', ['category' => \App\Models\Category::find($id) ])}}" method="POST" style="display:none">
        @csrf
        @method('DELETE')
    </form>

    <button x-on:click="sweetalert()" type="submit" class="btn btn-red cursor-pointer">Eliminar</button>

</div>

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('vendor/functionsjs/admin-ajax-delete.js')}}"></script>
@endpush