window.onload = function () {

    Livewire.on('btn',function(){
        if ($(".dropdown-menu").hasClass("invisible")) {
            $(".dropdown-menu").removeClass("invisible");
            $(".dropdown-menu").addClass("visible");
        } else {
            $(".dropdown-menu").removeClass("visible");
            $(".dropdown-menu").addClass("invisible");

        }
    });


/* ------------------------------------------------------------------------ */

    Livewire.on('actualizar_update_select', function (e) {

        Livewire.emitTo('productos.productos', 'select_update', e);

    });


    //alerta de validacion
    Livewire.on('alert_validation', etc6 => {

        Swal.fire({
            icon: 'debe completar los datos abligatorios',
            title: 'Oops...',
            text: 'Something went wrong!',

          })

        $('html, body').animate({

            scrollTop: 0

        }, 1000);

    });
    //bloquear boton de copiar cuando se este editando
    Livewire.on('bolqueo_copy', etc2 => {
        $('.copiar').attr('disabled', true);

        $('html, body').animate({

            scrollTop: 0

        }, 1000);

    });
    //alertta de editado
    Livewire.on('alert_update', etc4 => {
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'producto editado correctamente',
            showConfirmButton: false,
            timer: 1500
        })

    });
    //alerta copi
    Livewire.on('subir-scroll', etc5 => {

        $('html, body').animate({

            scrollTop: 0

        }, 1000);

    });


    //alerta de guardado
    Livewire.on('alert_guardado', () => {

        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'producto cuardado correctamente',
            showConfirmButton: false,
            timer: 1500
        })

    });
    // alerta borrado
    Livewire.on('borrar', productoId => {

        Swal.fire({
            title: 'estas seguro?',
            text: "no podras revertir esta accion!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'si, eliminarlo!'
        }).then((result) => {
            if (result.isConfirmed) {

                Livewire.emitTo('productos.productos', 'destroy', productoId);

                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        })

    });

};








