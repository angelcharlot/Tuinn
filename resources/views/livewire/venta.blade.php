<div>


    <div class="mt-4 mb-2 ml-3 text-base font-bold text-left text-gray-500">Terminal de venta:{{ $caja->nombre }}</div>
    <div class="flex flex-col pt-16 mx-auto md:flex-row">


        {{-- lista de productos --}}
        <div class="px-4 md:w-1/2">
            <h1 class="mb-4 text-2xl font-bold">Productos</h1>
            <div class="grid grid-cols-7 gap-4 overflow-y-auto h-96">
                @foreach ($productos as $producto)
                    @if ($producto->presentaciones->count() == 1)
                        <div wire:click="addProduct('{{ $producto->id }}', '{{ $producto->presentaciones->first()->name }}', {{ $producto->presentaciones->first()->precio_venta }})"
                            class="relative w-full h-24 bg-white rounded-lg shadow-md">
                            <img class="object-cover w-full h-24" src="{{ $producto->img }}" alt="{{ $producto->name }}">
                            <div class="absolute bottom-0 left-0 right-0 h-5 bg-gray-200">
                                <h2 class="text-xs font-bold text-center text-gray-900 truncate">{{ $producto->name }}
                                </h2>
                            </div>

                        </div>
                    @else
                        <div wire:click="verPresentaciones({{ $producto->id }})"
                            class="relative w-full h-24 overflow-hidden bg-white rounded-lg shadow-md">
                            <img class="object-cover w-full h-24" src="{{ $producto->img }}"
                                alt="{{ $producto->name }}">
                            <div class="absolute bottom-0 left-0 right-0 h-5 bg-gray-200">
                                <h2 class="text-xs font-bold text-center text-gray-900 truncate">{{ $producto->name }}
                                </h2>
                            </div>

                        </div>
                    @endif
                @endforeach

            </div>
            {{-- area de opciones  --}}
            <div class="grid w-full grid-cols-7 ">
                <button class="w-24 h-24 font-bold text-white bg-green-500 rounded-lg ">Cambio de mesas</button>

                <button class="w-24 h-24 font-bold text-white bg-yellow-500 rounded-lg">venta en mesas</button>

                <button wire:click="modal_ingresoyegreso" class="w-24 h-24 font-bold text-white bg-red-500 rounded-lg">ingreso y egreso de efectivo</button>

               
                <button class="w-24 h-24 font-bold text-white bg-purple-500 rounded-lg">Arqueo de caja</button>
                @if ($bn_apertura == 0)
                    <button wire:click="aperturar_caja_modal"
                        class="w-24 h-24 font-bold text-white bg-teal-500 rounded-lg">aperturar caja</button>
                @else
                    <button wire:click="cierre_de_caja"
                        class="w-24 h-24 font-bold text-white bg-teal-500 rounded-lg">Cerrar caja</button>
                @endif


            </div>
        </div>

        {{-- area de venta --}}
        <div class="px-4 md:w-1/2">
            <h1 class="mb-4 text-2xl font-bold">{{ $tipo_de_venta }}</h1>

            <div class="overflow-y-auto rounded-lg shadow-xl bg-gradient-to-br from-white to-gray-100 h-96 ">
                <table class="relative w-full bg-white rounded-lg shadow-md table-fixed">
                    <thead class="absolute top-0 w-full h-20 ">
                        <tr class="border-b-2 border-gray-300">
                            <th
                                class="w-1/4 px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Cantidad</th>
                            <th
                                class="w-1/2 px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Producto</th>
                            <th
                                class="w-1/4 px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Precio</th>
                            <th
                                class="w-1/4 px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Sub Total</th>
                        </tr>
                    </thead>
                    <tbody class="absolute w-full top-16">
                        @foreach ($detalles as $detalle)
                            <tr class="w-full border-b border-gray-200">
                                <td class="w-1/4 px-4 py-2 text-xs">{{ $detalle['cantidad'] }}</td>
                                <td class="w-1/2 px-4 py-2 text-xs">{{ $detalle['name'] }} -
                                    {{ $detalle['tipo_presentacion'] }}</td>
                                <td class="w-1/4 px-4 py-2 text-xs text-right">
                                    €{{ number_format($detalle['precio_venta'], 2) }}</td>
                                <td class="w-1/4 px-4 py-2 text-xs text-right">
                                    €{{ number_format($detalle['cantidad'] * $detalle['precio_venta'], 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class="flex justify-between p-4 text-xl">
                <p class="font-medium text-gray-700">Total:</p>
                <p class="font-bold text-gray-700">€{{ number_format($total, 2) }} </p>
            </div>
            <div class="flex justify-between gap-2 p-4">
                <button wire:click="venta_en_barra_rapida"
                    class="w-full px-4 py-2 mb-4 text-xs font-bold text-white bg-blue-500 rounded-lg hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                    Finalizar venta
                </button>
                <button wire:click="cancelar"
                    class="w-full px-4 py-2 mb-4 text-xs font-bold text-white bg-red-500 rounded-lg hover:bg-red-700 focus:outline-none focus:shadow-outline-blue">
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
                                class="w-full py-4 my-2 font-bold text-white bg-blue-500 rounded-lg shadow-md hover:bg-blue-700">{{ $presentacion->name }}</button>
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
            <div class="p-4 mb-5 text-yellow-700 bg-yellow-100 border-l-4 border-yellow-500" role="alert">
                <p class="font-bold">¡Alerta! La caja está cerrada.</p>
                <p>
                    Para poder abrirla, es necesario que rellene todos los campos requeridos. Por favor, asegúrese de
                    proporcionar la información necesaria para acceder a su contenido. Si tiene alguna pregunta o
                    necesita ayuda adicional, no dude en ponerse en contacto con nuestro equipo de soporte. ¡Gracias por
                    su cooperación!</p>
            </div>

            <div>
                <div>monto en caja: {{ $monto_caja }}</div>
                <div>diferencia: {{ $diferencia_caja }}</div>
                <form wire:submit.prevent="aperturar">
                    <div class="flex flex-col space-y-2">
                        <label for="monto" class="text-sm font-medium">Monto inicial</label>
                        <div class="relative">
                            <input type="number" class="w-full pr-12 form-input sm:text-sm sm:leading-5" id="monto"
                                wire:model="monto" wire:change="update_diferencia">
                            @error('monto')
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
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
                        class="inline-flex items-center justify-center px-4 py-2 mt-5 text-sm font-medium text-gray-800 bg-green-500 border border-transparent rounded-md shadow-sm ">
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
            <x-jet-secondary-button wire:click="$set('modal_apertura_de_caja',false)">
                Cerrar
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>
    {{-- modal para ingresos y egresos --}}
    <x-jet-dialog-modal wire:model="showModalingresoyegreso">
        <x-slot name="title">
            Operacion en caja
        </x-slot>
        <x-slot name="content">
            <div>
                <x-jet-label for="monto" value="Monto" />
                <x-jet-input type="number" class="block w-full mt-1" wire:model="monto_operacion" />
                <x-jet-input-error for="monto_operacion" />
            </div>
    
            <div class="mt-4">
                <x-jet-label for="observacion" value="Observación" />
                <textarea id="observacion" class="block w-full mt-1 rounded-md shadow-sm form-input" wire:model="observacion"></textarea>
                <x-jet-input-error for="observacion" />
            </div>
    
            <div class="mt-4">
                <x-jet-label for="tipoMovimiento" value="Tipo de movimiento" />
                <select id="tipoMovimiento" class="block w-full mt-1 rounded-md shadow-sm form-select" wire:model="tipoMovimiento">
                    <option value="ingreso">Ingreso</option>
                    <option value="egreso">Egreso</option>
                </select>
                <x-jet-input-error for="tipoMovimiento" />
            </div>
        </x-slot>
    
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('showModalingresoyegreso',false)" wire:loading.attr="disabled">
                Cancelar
            </x-jet-secondary-button>
    
            <x-jet-button wire:click="registrarMovimiento" wire:loading.attr="disabled">
                Registrar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
{{--     <x-jet-dialog-modal wire:model="showModacierre_caja">
    </x-jet-dialog-modal> --}}
    


</div>
