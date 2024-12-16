<div class="flex space-x-1" x-data="{
    page: 'subcategories',
    sweetalert(){
        let page = this.page;
        let item = 'subcategoria';
        let form = $refs.formDeleteLevel;

        //esta función esta en: resources/assets/js/
        alertConfirmation(form, page, item)
    }
}">
    
    <a class="btn btn-green" href="{{route('admin.subcategories.edit', [
        'subcategory' => $id
    ])}}">Editar</a>

    <form x-ref="formDeleteSubcategory" class="hidden" action="{{route('admin.subcategories.destroy', ['subcategory' => $id])}}" method="POST">
        @csrf
        @method('DELETE')
    </form>

    <button type="submit" x-on:click="sweetalert()" class="btn btn-red cursor-pointer">Eliminar</button>

</div>

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('vendor/functionsjs/admin-ajax-delete.js')}}"></script>
@endpush