function alertConfirmation(form, page, item){

    let texto1 = 'Deseas eliminar este ' + item + '?';
    let texto2 = "El " + item + " ha sido eliminado";

    if(item == 'categoria' || item == 'subcategoria' || item == 'etiqueta'){
        texto1 = 'Deseas eliminar esta ' + item + '?';
        texto2 = "La " + item + " ha sido eliminada";
    }
    // console.log(form.action)
    Swal.fire({
        title: texto1,
        text: "Si continuas se borrara de tu base de datos!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Eliminar",
        cancelButtonText: "Cancelar",

    }).then((result) => {

        if (result.isConfirmed) {

            fetch(form.action, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => {

                //console.log(response)
                if (!response.ok) {
                    throw new Error('La petición ha fallado');
                }

                if(response.ok){

                    Swal.fire({
                        title: "Eliminado!",
                        text:   texto2,
                        icon: "success"
                    });

                    const protocolo = window.location.protocol;
                    // Obtener el nombre del host
                    const nombreHost = window.location.hostname;
                    const route = protocolo + '//' + nombreHost + '/admin/' + page;
                    window.location.href = route;
                    
                }


            })
            .catch(error => {
                //console.error('Error al eliminar el rol:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Ha ocurrido un error, este '+ item + ' no se puede eliminar'
                });
            })

            
        }
    });
}

