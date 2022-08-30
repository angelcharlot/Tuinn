<div class=" min-h-screen mx-auto p-10 w-full md:w-11/12 bg-cool-gray-50 shadow-lg my-5  ">
    {{-- formularios --}}

    @if ($updateMode)
        @include('livewire.productos.update')
    @else
        @include('livewire.productos.create')
    @endif
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
                    <th
                        class=" hidden md:table-cell ">
                        nombre
                    </th>
                    <th class="  ">
                        Venta &euro;
                    </th>
                    <th class="  ">
                        Compra &euro;
                    </th>
                    <th class=" ">
                        categoria
                    </th>
                    <th
                        class=" hidden md:table-cell ">
                        volumen/und medida
                    </th>
                    <th
                        class=" hidden md:table-cell ">
                        Accions

                    </th>

                </tr>
            </thead>
            @foreach ($user->productos as $producto)
                <tbody class="bg-white border-b-2 ">
                    <tr>
                        <td
                            class="">
                            <img class=" h24-  md:h-16 w-48 md:w-16  rounded-lg border border-gray-200"
                                src="{{ asset($producto->img) }}" alt="Current profile photo" />
                        </td>
                        <td class=" ">
                            {{ $producto->id }}
                        </td>
                        <td class=" hidden md:table-cell ">
                            {{ $producto->name }}
                        </td>
                        <td class=" ">
                            {{ $producto->precio_venta }}
                        </td>
                        <td class="">
                            {{ $producto->precio_compra }}
                        </td>
                        <td class="  ">
                            {{ $producto->categoria->name }}
                        </td>
                        <td class=" hidden md:table-cell ">
                            {{ $producto->volumen }}/{{ $producto->unidad_medida }}
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
                        <td class=" border-slate-100  p-2 md:p-4 text-gray-500" colspan="5">Volumen:
                            {{ $producto->volumen }}/{{ $producto->unidad_medida }}</td>
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
    <div id="myModal"  class="modalContainer ">
        <div class="modal-content ">
            <span class="close">×</span>
            <h2>Modal</h2>
            <p>Se ha desplegado el modal y bloqueado el scroll del body!</p>
            @livewire('categorias.categorias')
        </div>
    </div>

    @push('js')
        <script src="{{ asset('js/producto/producto.js') }}"></script>
    @endpush


</div>
