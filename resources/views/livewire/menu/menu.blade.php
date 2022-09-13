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
            <div
                class=" grid-cols-2 grid border border-gray-200 m-1 rounded-md shadow-xs p-1 hover:border-indigo-300 hover:shadow-2xl ">
                <div><img class="w-full rounded-md" src="{{ asset($producto->img) }}" alt="Sunset in the mountains">
                </div>
                <div>
                    <table class="w-full ">
                        <tbody>
                            <tr>
                                <td class=" text-center font-extrabold  ">
                                    {{ $producto->name }}
                                </td>
                            </tr>

                            <tr>
                                <td class="text-center text-green-900 text-2xl font-medium ">
                                    &euro; {{ $producto->precio_venta }}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class="col-span-2 text-ellipsis overflow-hidden ... h-10  ">
                    {{ $producto->descrip }}
                </div>
                <div class="col-span-2">
                    @foreach ($producto->categorias as $categoria)
                        <span style="font-size: 8px;line-height: 11px;letter-spacing: 0.027em;font-weight: 875;"
                            class="inline-block bg-gray-200 rounded-full px-1 py-1  font-semibold text-gray-700 mr-2 mb-2">#{{ $categoria->name }}</span>
                    @endforeach
                </div>
            </div>
        @endforeach

    </div>
    <div class="mt-5 w-full flex-row text-center mb-10">
        <button wire:click="navegacion('{{ $categoria_padre->id }}',1)"
            class="py-2 px-4  bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">volver</button>
    </div>


</div>
