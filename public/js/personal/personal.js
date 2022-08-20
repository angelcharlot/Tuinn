window.onload = function () {



    Livewire.on('subir-scroll', etc5 => {

        $('html, body').animate({

            scrollTop: 0

        }, 1000);

    });

    Livewire.on('alert_guardad', x => {
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Your work has been saved',
            showConfirmButton: false,
            timer: 1500
        })


    });

    Livewire.on('block_eliminar', x => {

        $('.borrarr').attr('disabled', true);

    });
    Livewire.on('alert_editado', x => {
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Your work has been saved',
            showConfirmButton: false,
            timer: 1500
        })


    });

    Livewire.on('delete', x => {

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {


                Livewire.emitTo('personal', 'destroy', x);
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )

            }
        })


    });



};
