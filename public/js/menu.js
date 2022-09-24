window.onload = function () {


    Livewire.on('refress_modal', function(){

        Livewire.emitTo('menu.menu', "$set('open',true)");

    });




};
