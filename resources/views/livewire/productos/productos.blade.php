<div class=" hoja_base div ">

@if (count($allcategorias)==0)

<h1 class="w-full h-16 rounded-md border border-red-700 p-4 bg-gray-50 text-lg text-center text-red-400">
    tiene que registrar las <a class="link underline decoration-solid hover:text-red-700" href="{{route('categorias.index')}}">categorias</a>

</h1>

@else



    {{-- loading --}}
    <div wire:loading wire:target="photo,changeEvent"
        class="fixed z-40 w-full h-full top-0 left-0 bg-gray-500 bg-opacity-25">
        <div class="w-ful h-full ">
            <div class="flex justify-center h-full">

                <div class="w-24 h-24 my-auto ">
                    <div role="status">
                        <svg class="animate-spin -ml-1 mr-3 h-18 w-18 text-blue-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                          </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- formularios --}}

    @if ($updateMode)
        @include('livewire.productos.update')
    @else
        @include('livewire.productos.create')
    @endif

    {{-- registros --}}

    <div class="shadow-sm overflow-hidden my-8">
        <h1 class="titulo_form">Productos</h1>
        <table class=" tabla md:text-base ">
            <thead>
                <tr class="">
                    <th class="">
                        img
                    </th>
                    <th class="">
                        id
                    </th>
                    <th class=" hidden md:table-cell ">
                        nombre
                    </th>
                    <th class=" ">
                        categoria
                    </th>
                   
                    <th class=" hidden md:table-cell ">
                        Accions

                    </th>

                </tr>
            </thead>

            @foreach ($productos as $producto)
                <tbody class="bg-white border-b-2 ">
                    <tr>
                        <td class="">
                            <img class=" h24-  md:h-16 w-48 md:w-16  rounded-lg border border-gray-200"
                                src="{{ asset($producto->img) }}" alt="Current profile photo" />
                        </td>
                        <td class=" ">
                            {{ $producto->id }}
                        </td>
                        <td class=" hidden md:table-cell ">
                            {{ $producto->name }}
                        </td>
                        <td class="  ">

                            @foreach ($producto->categorias as $categoria )
                                {{$categoria->name}}
                            @endforeach




                        </td>
                     
                        <td class=" hidden md:table-cell ">
                            <button wire:click="edit({{ $producto->id }})"
                                class="px-2  bg-indigo-200 text-indigo-500 hover:bg-indigo-500 hover:text-white rounded">Editar</button>
                            <button wire:click="copiar({{ $producto->id }})"
                                class="px-2 copiar disabled:bg-blue-800 bg-green-200 text-green-500 hover:bg-green-500 hover:text-white rounded">copiar</button>

                            <button wire:click="$emit('borrar',{{ $producto->id }})"
                                class="px-2   bg-red-200 text-red-500 hover:bg-red-500 hover:text-white rounded">Borrar</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="hidden md:table-cell p-2 md:p-4 text-gray-700 " colspan="8">
                            <span class="font-bold text-sm text-black"> Descripcion: </span>{{ $producto->descrip }}
                        </td>
                    </tr>


                    <tr class="visible md:hidden ">
                        <td class=" border-slate-100  p-2 md:p-4 text-gray-500" colspan="5">Nombre:
                            {{ $producto->name }}</td>
                    </tr>

                    
                    <tr class="visible md:hidden ">
                        <td class=" p-2 md:p-4 text-gray-700 " colspan="8">
                            <span class="font-bold text-sm text-black"> Descripcion: </span>{{ $producto->descrip }}
                        </td>
                    </tr>
                    <tr class="visible md:hidden ">
                        <td class=" border-slate-100  p-2 md:p-4 text-gray-500" colspan="5">
                            <button wire:click="edit({{ $producto->id }})"
                                class="px-2  bg-indigo-200 text-indigo-500 hover:bg-indigo-500 hover:text-white rounded">Editar</button>
                            <button wire:click="copiar({{ $producto->id }})"
                                class="px-2 copiar disabled:bg-blue-800 bg-green-200 text-green-500 hover:bg-green-500 hover:text-white rounded">copiar</button>

                            <button wire:click="$emit('borrar',{{ $producto->id }})"
                                class="px-2   bg-red-200 text-red-500 hover:bg-red-500 hover:text-white rounded">Borrar</button>

                        </td>
                    </tr>
                </tbody>
            @endforeach

        </table>
    </div>

@endif
</div>
