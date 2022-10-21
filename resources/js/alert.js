window.onload = function () {

   
   Livewire.on('ok', function(){

            Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'ok',
            showConfirmButton: false,
            timer: 1500
        })

    });
    Livewire.on('btn',function(){
        if ($(".dropdown-menu").hasClass("invisible")) {
            $(".dropdown-menu").removeClass("invisible");
            $(".dropdown-menu").addClass("visible");
        } else {
            $(".dropdown-menu").removeClass("visible");
            $(".dropdown-menu").addClass("invisible");

        }
    });
    
};
