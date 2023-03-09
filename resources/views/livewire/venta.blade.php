<div>

    <script>
        var pc = new RTCPeerConnection({iceServers:[]});
        pc.createDataChannel("");
        pc.onicecandidate = function(event) {
            if (event.candidate) {
                // Obtener la dirección IP local
                var ip = event.candidate.address;
                console.log("Dirección IP local: " + ip);
                // Actualizar la propiedad del componente Livewire
                Livewire.emit('updateLocalIpAddress', ip);
                pc.close();
            }
        };
    </script>

    <div class="text-base font-bold mt-4 ml-3 mb-2 text-left text-gray-500">Terminal de venta:{{$caja->nombre}}</div>
    <div class="flex flex-col md:flex-row mx-auto pt-16">

       
        {{-- lista de productos --}}
        <div class="md:w-1/2 px-4">
            <h1 class="text-2xl font-bold mb-4">Productos</h1>
            <div class="grid grid-cols-7 gap-4 h-96 overflow-y-auto">
                @foreach ($productos as $producto)
                    @if ($producto->presentaciones->count() == 1)
                        <div wire:click="addProduct('{{ $producto->id }}', '{{ $producto->presentaciones->first()->name }}', {{ $producto->presentaciones->first()->precio_venta }})"
                            class="bg-white rounded-lg shadow-md  relative w-full h-24">
                            <img class="h-24 w-full object-cover" src="{{ $producto->img }}" alt="{{ $producto->name }}">
                            <div class="absolute bottom-0 left-0 right-0 h-5  bg-gray-200">
                                <h2 class="text-xs font-bold text-center text-gray-900 truncate">{{ $producto->name }}
                                </h2>
                            </div>

                        </div>
                    @else
                        <div wire:click="verPresentaciones({{ $producto->id }})"
                            class="bg-white rounded-lg shadow-md overflow-hidden relative w-full h-24">
                            <img class="h-24 w-full object-cover" src="{{ $producto->img }}"
                                alt="{{ $producto->name }}">
                            <div class="absolute bottom-0 left-0 right-0 h-5  bg-gray-200">
                                <h2 class="text-xs font-bold text-center text-gray-900 truncate">{{ $producto->name }}
                                </h2>
                            </div>

                        </div>
                    @endif
                @endforeach

            </div>
            {{-- area de opciones  --}}
            <div class="w-full grid grid-cols-5">
                <button class="w-32 h-32 bg-green-500 text-white font-bold rounded-lg">Cambio de mesas</button>

                <button class="w-32 h-32 bg-yellow-500 text-white font-bold rounded-lg">venta en mesas</button>

                <button class="w-32 h-32 bg-red-500 text-white font-bold rounded-lg">Opción 4</button>

                <button class="w-32 h-32 bg-purple-500 text-white font-bold rounded-lg">Arqueo de caja</button>

                <button wire:click="prueba" class="w-32 h-32 bg-teal-500 text-white font-bold rounded-lg">cierre de
                    operaciones</button>

            </div>
        </div>

        {{-- area de venta --}}
        <div class="md:w-1/2  px-4">
            <h1 class="text-2xl font-bold mb-4">{{ $tipo_de_venta }}</h1>

            <div class="bg-gradient-to-br from-white to-gray-100 rounded-lg shadow-xl h-96 overflow-y-auto ">
                <table class="relative w-full table-fixed bg-white rounded-lg shadow-md">
                    <thead class=" absolute top-0 w-full h-20">
                        <tr class="border-b-2 border-gray-300">
                            <th
                                class="w-1/4 py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Cantidad</th>
                            <th
                                class="w-1/2 py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Producto</th>
                            <th
                                class="w-1/4 py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Precio</th>
                            <th
                                class="w-1/4 py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Sub Total</th>
                        </tr>
                    </thead>
                    <tbody class="absolute top-16 w-full">
                        @foreach ($detalles as $detalle)
                            <tr class="border-b border-gray-200 w-full">
                                <td class="w-1/4 py-2 px-4 text-xs">{{ $detalle['cantidad'] }}</td>
                                <td class="w-1/2 py-2 px-4 text-xs">{{ $detalle['name'] }} -
                                    {{ $detalle['tipo_presentacion'] }}</td>
                                <td class="w-1/4 py-2 px-4 text-xs text-right">
                                    €{{ number_format($detalle['precio_venta'], 2) }}</td>
                                <td class="w-1/4 py-2 px-4 text-xs text-right">
                                    €{{ number_format($detalle['cantidad'] * $detalle['precio_venta'], 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class="p-4 flex text-xl justify-between">
                <p class="text-gray-700  font-medium">Total:</p>
                <p class="text-gray-700  font-bold">€{{ number_format($total, 2) }} </p>
            </div>
            <div class="p-4 flex justify-between gap-2">
                <button
                    class="bg-blue-500 w-full hover:bg-blue-700 text-white font-bold  py-2 px-4 text-xs rounded-lg mb-4 focus:outline-none focus:shadow-outline-blue">
                    Finalizar venta
                </button>
                <button wire:click="cancelar"
                    class="bg-red-500 w-full hover:bg-red-700 text-white font-bold py-2 px-4 text-xs rounded-lg mb-4 focus:outline-none focus:shadow-outline-blue">
                    Cancelar
                </button>
            </div>


            {{-- modal de presentaciones  --}}


        </div>




    </div>
    {{-- modal para presentaciones --}}
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
    {{-- modal para informacion de creacion de caja --}}
    <x-jet-dialog-modal wire:model="modal_caja">
        <x-slot name="title">
            registro de caja
        </x-slot>

        <x-slot name="content">
            "Estimado/a usuario/a, le informamos que se ha asignado la PC actual como una caja. A partir de ahora, podrá
            realizar todas las operaciones necesarias para la apertura y cierre de caja desde este dispositivo. Si tiene
            alguna duda o problema, por favor no dude en contactarnos. ¡Gracias por utilizar nuestros servicios!"
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('modal_caja',false)">
                Cerrar
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
    {{-- modal para inicio de operaciones o apertura de caja --}}
    <x-jet-dialog-modal wire:model="modal_apertura_de_caja">
        <x-slot name="title">
            Apertura de caja
        </x-slot>
        <x-slot name="content">
            <div class="bg-yellow-100 border-l-4 mb-5 border-yellow-500 text-yellow-700 p-4" role="alert">
                <p class="font-bold">¡Alerta! La caja está cerrada.</p>
                <p>
                    Para poder abrirla, es necesario que rellene todos los campos requeridos. Por favor, asegúrese de
                    proporcionar la información necesaria para acceder a su contenido. Si tiene alguna pregunta o
                    necesita ayuda adicional, no dude en ponerse en contacto con nuestro equipo de soporte. ¡Gracias por
                    su cooperación!</p>
            </div>

            <div>
                <div>monto en caja: {{$monto_caja}}</div>
                <div>diferencia: {{$diferencia_caja}}</div>
                <form wire:submit.prevent="aperturar">
                    <div class="flex flex-col space-y-2">
                        <label for="monto" class="text-sm font-medium">Monto inicial</label>
                        <div class="relative">
                            <input type="number" class="w-full pr-12 form-input sm:text-sm sm:leading-5" id="monto"
                                wire:model="monto"
                                wire:change="update_diferencia">
                            @error('monto')
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 2a8 8 0 100 16 8 8 0 000-16zM9 13a1 1 0 112 0 1 1 0 01-2 0zm1-8a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            @enderror
                        </div>
                        @error('monto')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit"
                        class="mt-5 inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-800 bg-green-500  ">
                        <span class="mr-2">
                            Aperturar caja
                        </span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </button>


                </form>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button>
                Cerrar
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
