<x-simple-email-content>

   <h3>Datos del usuario</h3>

   <p>
      Nombre: {{$data['user_name']}}
   </p>
   <p>
      Email: {{$data['email']}}
   </p>
   <p>
      Tema: {{$data['tema']}}
   </p>
   <p>
      Categorias: {{$data['categorias']}}
   </p>
   <p>
      Subcategorias: {{$data['subcategorias']}}
   </p>
   <p>
      Fecha: {{$data['fecha']}}
   </p>

</x-simple-email-content>