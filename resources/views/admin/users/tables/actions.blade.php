<div class="flex space-x-1">
    
    <a class="btn btn-green" href="{{route('admin.users.edit', [
        'user' => $id
    ])}}">Editar</a>

    <a class="btn btn-red hidden" href="{{route('admin.users.destroy', [
        'user' => $id
    ])}}">eliminar</a>

</div>
