
window.onload = function () {

    Livewire.on('borrar', productoId => {

        Swal.fire({
            title: 'estas seguro?',
            text: "esta accion es irreversible!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'si , eliminar este registro!'
        }).then((result) => {
            if (result.isConfirmed) {


                Livewire.emitTo('categorias.categorias', 'destroy', productoId);
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )

            }
        })
    
    

    });

};