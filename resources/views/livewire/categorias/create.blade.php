<div class="w-full">
    <h1 class="titulo_form">
        Registrar categoria</h1>
        <div class="div-form-container grid grid-cols-1 sm:grid-cols-2 ">

         {{-- id_padre --}}
         <div class="w-auto px-3 hidden ">
            <label class="text-xs text-gray-500 mx-1 " for="name">pertenese a:</label>
            <input disabled
                class=""
                id="name" wire:model="id_padre_categoria" type="text" placeholder="">
            @error('id_padre_categoria')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
        </div>
        {{-- nombre --}}
        <div class="w-auto px-3">
            <label class="text-xs text-gray-500 mx-1 " for="name">Nombre</label>
            <input
                class=""
                id="name" wire:model="name" type="text" placeholder="Nombre completo...">
            @error('name')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
        </div>
          {{-- descrip --}}
          <div class="w-auto px-3">
            <label class="text-xs text-gray-500 mx-1 " for="name">Drescripcion</label>
            <input
                class=""
                id="name" wire:model="descrip" type="text" placeholder="">
            @error('descrip')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
        </div>
        <div>
        </div>
        <div class="w-auto pl-3 text-center align-middle col-span-1 md:col-span-3 sm:grid-cols-2">
            <div class="pt-5">
                <button wire:click="store()"
                    class="px-3 py-2 bg-indigo-200 text-indigo-500 hover:bg-indigo-500 hover:text-indigo-100 rounded">Agregar</button>
            </div>
        </div>

        </div>



</div>
