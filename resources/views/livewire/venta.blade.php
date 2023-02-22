<div class="flex flex-col md:flex-row mx-auto">
    <div class="md:w-1/2 px-4">
        <h1 class="text-2xl font-bold mb-4">Productos</h1>
        <div class="grid grid-cols-5 gap-4">
            @foreach ($productos as $producto)
                @if ($producto->presentaciones->count() == 1)
                    <div wire:click="addProduct('{{ $producto->id }}', '{{ $producto->presentaciones->first()->name }}', {{ $producto->presentaciones->first()->precio_venta }})"
                        class="bg-white rounded-lg shadow-md overflow-hidden relative w-full">
                        <img class="h-24 w-full object-cover" src="{{ $producto->img }}" alt="{{ $producto->name }}">
                        <div class="absolute bottom-0 left-0 right-0 h-5  bg-gray-200">
                            <h2 class="text-xs font-bold text-center text-gray-900 truncate">{{ $producto->name }}</h2>
                        </div>

                    </div>
                @else
                    <div wire:click="verPresentaciones({{ $producto->id }})"
                        class="bg-white rounded-lg shadow-md overflow-hidden relative w-full">
                        <img class="h-24 w-full object-cover" src="{{ $producto->img }}" alt="{{ $producto->name }}">
                        <div class="absolute bottom-0 left-0 right-0 h-5  bg-gray-200">
                            <h2 class="text-xs font-bold text-center text-gray-900 truncate">{{ $producto->name }}</h2>
                        </div>

                    </div>
                @endif
            @endforeach

        </div>
    </div>
    <div class="md:w-1/2 px-4">
        <h1 class="text-2xl font-bold mb-4">Carrito</h1>
        <div class="bg-white rounded-lg shadow-md overflow-y-scroll" style="max-height: 500px;">
            <table class="w-full table-fixed">
                <thead>
                    <tr class="border-b-2 border-gray-300">
                        <th class="w-1/4 py-2 px-4">Cantidad</th>
                        <th class="w-1/2 py-2 px-4">Producto</th>
                        <th class="w-1/4 py-2 px-4">Precio</th>
                        <th class="w-1/4 py-2 px-4">total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detalles as $detalle)
                        <tr>
                            <td>{{ $detalle['cantidad'] }}</td>
                            <td>{{ $detalle['name'] }}-{{ $detalle['tipo_presentacion'] }}</td>
                            <td>{{ $detalle['precio_venta'] }}</td>
                            <td>{{ $detalle['cantidad'] * $detalle['precio_venta'] }}</td>
                        </tr>
                    @endforeach



                </tbody>
            </table>
            <div class="p-4 flex justify-between">
                <p class="text-gray-700 text-base font-bold">Total:</p>
                <p class="text-gray-700 text-base font-bold">${{ $total }} </p>
            </div>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full mb-4">Finalizar
                compra</button>
        </div>


        <x-jet-dialog-modal wire:model="showModal">
            <x-slot name="title">
                Presentaciones del producto "{{ $productoselect->name }}"
            </x-slot>

            <x-slot name="content">
                @if ($presentaciones->count() > 0)
                    <ul class="grid grid-cols-1 gap-2">
                        @foreach ($presentaciones as $presentacion)
                            <li>
                                <button
                                    wire:click="addProduct('{{ $productoselect->id }}', '{{ $presentacion->name }}', {{ $presentacion->precio_venta }})"
                                    class="w-full py-4 bg-blue-500 text-white font-bold rounded-lg shadow-md hover:bg-blue-700 my-2">{{ $presentacion->name }}</button>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>No hay presentaciones disponibles para este producto.</p>
                @endif
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('showModal')" wire:loading.attr="disabled">
                    Cerrar
                </x-jet-secondary-button>
            </x-slot>
        </x-jet-dialog-modal>

    </div>
</div>
