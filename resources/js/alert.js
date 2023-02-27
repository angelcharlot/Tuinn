
   Livewire.on('ok', function(){

            Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'ok',
            showConfirmButton: false,
            timer: 1500
        })

    });
    Livewire.on('productoAgregado', function(){
        Swal.fire({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 2000,
            icon: 'success',
            title: 'Producto agregado a la venta',
            customClass: {
                popup: 'bg-green-500 text-white',
                title: 'text-lg',
            }
        })
    });
    Livewire.on('votoguardado1', function(){

        Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'gracias por tu like',
        showConfirmButton: false,
        timer: 1500
    })

});
Livewire.on('votoguardado0', function(){

    Swal.fire({
    position: 'top-end',
    icon: 'warning',
    title: 'sentimos que no te guste nuestro producto',
    showConfirmButton: false,
    timer: 1500
})

});
  
    Livewire.on('unsolovoto', function(){

        Swal.fire({
        position: 'center',
        icon: 'warning',
        title: 'solo puedes emitir un like por producto',
        showConfirmButton: false,
        timer: 1500
    })

});


