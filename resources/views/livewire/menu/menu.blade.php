<div class=" bg-whitem mb-10 h-min-screen my-10 container mx-auto rounded-md shadow-sm ">

    <div class="w-full my-3">
        <div class="w-full">
            <img src="{{ asset($negocio->img) }}" alt="">
        </div>

        <div class="text-center  mt-3 text-lg font-bold">{{ $negocio->name }}</div>
        <div class="text-center text-md">{{ $negocio->direccion }}</div>
        <div class="text-center mb-3 text-xs">{{ $negocio->nif }}</div>
    </div>

    {{-- <div class="w-full font-semibold text-lg text-center ">{{$categoria_padre->name}}</div> --}}
    <div class="div-form-container grid grid-cols-4 gap-1 mb-5">
        @foreach ($categorias as $categoria)
            @if (count($categoria->productos) > 0)
                <div
                    class=" col-span-1 cursor-pointer  border-b-4  border-gray-100 bg-white h-8 font-bold text-xs text-center py-1 rounded-sm  hover:border-indigo-700 hover:shadow-2xl  ">
                    <div wire:click="navegacion({{ $categoria->id }},0)"> {{ $categoria->name }} <div
                            class=" inline-block bg-blue-500 rounded-2xl w-6 my-1 text-white boder border-blue-800">
                            {{ count($categoria->productos) }}</div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <div class=" grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-3 text-xs mx-auto">

        @foreach ($categoria_padre->productos as $producto)
            @livewire('show-producto', ['id_producto' => $producto->id],key($producto->id))
        @endforeach

    </div>
    <div class="mt-5 w-full flex-row text-center mb-10">
        <button wire:click="navegacion('{{ $categoria_padre->id }}',1)"
            class="py-2 px-4  bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">volver</button>
    </div>



</div>
