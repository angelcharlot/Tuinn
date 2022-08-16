<div class=" min-h-screen mx-auto p-10 w-full md:w-11/12 bg-cool-gray-50 shadow-lg my-5  ">
    {{-- formularios --}}

    @if ($updateMode)
        @include('livewire.productos.update')
    @else
        @include('livewire.productos.create')
    @endif



    <div class="shadow-sm overflow-hidden my-8">
        <h1 class=" inline-block text-2xl sm:text-3xl font-extrabold text-gray-500 tracking-tight ">Productos</h1>
        <table class=" mt-10 border-collapse table-auto  w-full text-xs md:text-sm ">
            <thead>
                <tr class="h-4 md:h-16 bg-gradient-to-b from-gray-50 to-gray-200">
                    <td class="  font-medium  p-2 md:p-4 pl-8 pt-0 pb-3 text-slate-400  text-left truncate">
                        img
                    </td>
                    <td class="  font-medium  p-2 md:p-4 pl-8 pt-0 pb-3 text-slate-400  text-left truncate">
                        id
                    </td>
                    <td
                        class=" hidden md:table-cell font-medium  p-2 md:p-4  pt-0 pb-3 text-slate-400 text-left truncate">
                        nombre
                    </td>
                    <td class="  font-medium  p-2 md:p-4  pt-0 pb-3 text-slate-400 text-left truncate">
                        Venta &euro;
                    </td>
                    <td class="  font-medium  p-2 md:p-4  pt-0 pb-3 text-slate-400 text-left truncate">
                        Compra &euro;
                    </td>
                    <td class="  font-medium  p-2 md:p-4   pt-0 pb-3 text-slate-400 text-left truncate">
                        categoria
                    </td>
                    <td
                        class=" hidden md:table-cell font-medium  p-2 md:p-4  pt-0 pb-3 text-slate-400 text-left truncate">
                        volumen/und medida
                    </td>
                    <td
                        class=" hidden md:table-cell font-medium  p-2 md:p-4  pt-0 pb-3 text-slate-400 text-left truncate">
                        Accions

                    </td>

                </tr>
            </thead>
            @foreach ($user->productos as $producto)
                <tbody class="bg-white border-b-2 border-slate-100">
                    <tr>
                        <td class=" border-slate-100
                        p-0
                        md:p-4
                        md:pl-8
                        pl-2
                        text-gray-500 truncate">
                            <img class=" h-24  md:h-16 md:mx-auto w-48 md:w-16 object-cover rounded-lg border border-gray-200"
                                src="{{ asset($producto->img) }}" alt="Current profile photo" />
                        </td>
                        <td class=" border-slate-100  p-2 md:p-4 pl-8 text-gray-500 truncate">
                            {{ $producto->id }}
                        </td>
                        <td class=" hidden md:table-cell border-slate-100  p-2 md:p-4 text-gray-500 truncate">
                            {{ $producto->name }}
                        </td>
                        <td class=" border-slate-100  p-2 md:p-4  text-gray-500 truncate">
                            {{ $producto->precio_venta }}
                        </td>
                        <td class=" border-slate-100  p-2 md:p-4  text-gray-500 truncate">
                            {{ $producto->precio_compra }}
                        </td>
                        <td class=" border-slate-100  p-2 md:p-4  text-gray-500 ">
                            {{ $producto->categoria->name }}
                        </td>
                        <td class=" hidden md:table-cell border-slate-100  p-2 md:p-4  text-gray-500 truncate">
                            {{ $producto->volumen }}/{{ $producto->unidad_medida }}
                        </td>
                        <td class=" hidden md:table-cell border-slate-100  p-2 md:p-4  text-gray-500 truncate">
                            <button wire:click="edit({{ $producto->id }})"
                                class="px-2  bg-indigo-200 text-indigo-500 hover:bg-indigo-500 hover:text-white rounded">Editar</button>
                            <button wire:click="copiar({{ $producto->id }})"
                                class="px-2 copiar disabled:bg-blue-800 bg-green-200 text-green-500 hover:bg-green-500 hover:text-white rounded">copiar</button>

                                <button wire:click="$emit('borrar',{{ $producto->id }})"
                                class="px-2   bg-red-200 text-red-500 hover:bg-red-500 hover:text-white rounded">Borrar</button>
                        </td>
                        <tr>
                            <td class="hidden md:table-cell p-2 md:p-4 text-gray-700 " colspan="8">
                                <span class="font-bold text-sm text-black"> Descripcion: </span>{{$producto->descrip}}
                            </td>
                        </tr>

                    </tr>
                    <tr class="visible md:hidden ">
                        <td class=" border-slate-100  p-2 md:p-4 text-gray-500" colspan="5">Nombre:
                            {{ $producto->name }}</td>
                    </tr>

                    <tr class="visible md:hidden ">
                        <td class=" border-slate-100  p-2 md:p-4 text-gray-500" colspan="5">Volumen:
                            {{ $producto->volumen }}/{{ $producto->unidad_medida }}</td>
                    </tr>
                    <tr class="visible md:hidden ">
                        <td class=" p-2 md:p-4 text-gray-700 " colspan="8">
                            <span class="font-bold text-sm text-black"> Descripcion: </span>{{$producto->descrip}}
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
    @push('js')
    <script src="{{asset('js/producto/producto.js')}}"></script>
    @endpush


</div>
