<div class="container mx-auto mt-1 md:mt-15">
    {{-- loading --}}
    <div wire:loading wire:target="selecionar_area,mostrar_comanda,agregar,comandar"
        class="fixed top-0 left-0 z-40 w-full h-full bg-gray-800 bg-opacity-75">
        <div class="h-full w-ful ">
            <div class="flex justify-center h-full">

                <div class="z-50 w-24 h-24 my-auto ">
                    <div role="status">
                        <svg class="mr-3 -ml-1 text-blue-800 animate-spin h-18 w-18" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="grid w-11/12 grid-cols-1 gap-5 mx-auto ">
        <div class="border border-gray-500">

            @switch($vista_principal)
                @case(1)
                    <div class="grid grid-cols-4 gap-5 p-2 ">

                        @foreach ($areas as $area)
                            <div wire:click="selecionar_area({{ $area->id }})">
                                <x-btn_areas>
                                    {{ $area->name }}
                                </x-btn_areas>
                            </div>
                        @endforeach

                    </div>
                @break

                @case(2)
                    <div class="grid grid-cols-4 gap-5 p-2 ">
                        @foreach ($area_seleccionada->mesas as $mesa)
                            <div wire:click="mostrar_comanda({{ $mesa->id }})">
                                <x-btn_areas>
                                    {{ $mesa->nro }}
                                </x-btn_areas>
                            </div>
                        @endforeach
                        <div wire:click="volver_areas">
                            <x-btn_areas>
                                Volver
                            </x-btn_areas>
                        </div>

                    </div>
                @break

                @case(3)
                    <div class="grid grid-cols-3 gap-0 text-xs font-bold text-white bg-blue-900 md:text-base">
                        <div class="col-span-3 text-lg text-center ">mesa:{{$mesa_seleccionada->area->name}}-{{ $mesa_seleccionada->nro }}</div>

                        <div class="px-1 text-left">tipo:{{ $mesa_seleccionada->documento->where('estado', '=', 'activa')->first()->tipo }}</div>
                        <div class="px-1 text-center">estado:{{ $mesa_seleccionada->documento->where('estado', '=', 'activa')->first()->estado }}</div>
                        <div class="px-1 text-right">N/S{{ $mesa_seleccionada->documento->where('estado', '=', 'activa')->first()->nro_documento }}
                        </div>
                    </div>
                    <table class="table w-full table-auto ">
                        <tr class="p-1 text-xs font-bold text-white bg-blue-900 md:text-base">
                            <td>#</td>
                            <td>descripcion</td>
                            {{-- <td class="text-right">P/U</td>
                            <td class="text-right"> total</td> --}}
                            <td>acciones</td>

                        </tr>

                        @foreach ($mesa_seleccionada->documento->where('estado', '=', 'activa')->first()->detalles as $detalle)
                            <tr class="p-1 text-xs border-b border-gray-500 md:text-base">

                                <td class="w-auto"> {{ $detalle->cantidad }}</td>
                                <td class="w-auto">{{ $detalle->name }}({{ $detalle->tipo_presentacion }})</td>
                               {{--  <td class="w-10 text-right">{{ number_format($detalle->precio_venta, 2, '.', '')  }}</td>
                                <td class="w-10 text-right">{{number_format( $detalle->precio_venta * $detalle->cantidad, 2, '.', '')  }}</td> --}}
                                <td>
                                    <div class="flex ">
                                    <i wire:click="disminuir({{$detalle->id}})" class="p-1 mr-4 text-white bg-red-700 cursor-pointer bi bi-dash rounded-sx"></i>
                                    <i wire:click="agregar({{ $detalle->producto->id }},{{ $detalle->producto->presentaciones->where('name','=',$detalle->tipo_presentacion)->first()->id }})" class="p-1 text-white bg-green-800 cursor-pointer bi bi-plus-lg rounded-sx"></i> 
                                    </div>
                                    
                                    
                                </td>
                                
                            </tr>
                        @endforeach

                    </table>
                    @if (count($array_comanda) > 0)
                        <x-jet-secondary-button class="m-5 text-center" wire:click="comandar">
                            comfirmar
                        </x-jet-secondary-button>
                    @endif
                @break

                @default
            @endswitch

        </div>
        @switch($mesas_view)
            @case(1)
                <div class="grid grid-cols-4 gap-1 p-2 overflow-auto border border-gray-500">
                    <div>Area</div>
                    <div>Nro mesa</div>
                    <div>Cantidad</div>
                    <div>N/F</div>
                  
                    @foreach ($areas as $area)
                        <div class=" col-span-4 text-center bg-gray-700 ">{{$area->name}}</div>
                        @foreach ($area->mesas as $mesa)
                            @foreach ($mesa->documento->where('estado','=','activa') as $documentos)
                            <div wire:click="mostrar_comanda({{ $documentos->mesa->id }})">{{$documentos->mesa->area->name}}</div>
                            <div>{{$documentos->mesa->nro}}</div>
                            <div>{{$documentos->total}}</div>
                            <div>{{$documentos->nro_documento}}</div>
                            @endforeach    
                        @endforeach
                            
                        
                    @endforeach
                </div>
            @break

            @case(2)
                <div class="grid grid-cols-4 gap-1 p-2 overflow-auto border border-gray-500 h-96">
                    @foreach ($productos as $key => $producto)
                        <x-btn-producto>
                            <div wire:click="mostrar_presentacion({{ $producto->id }})">
                                <div class="truncate ">{{ $producto->id }}</div>
                                <div>{{ $producto->name }}</div>
                            </div>

                        </x-btn-producto>
                    @endforeach
                </div>
            @break

            @default
        @endswitch
        @if ($documento)
            <x-jet-secondary-button class="fixed bottom-0 left-0 w-full text-center " wire:click="imprimir_tiket({{$documento->id}})">
            tiker
        </x-jet-secondary-button>
        @endif
        
    </div>
    @if ($presentaciones_view == 1)
        <div class="fixed top-0 left-0 flex items-center w-full h-full bg-blue-300 bg-opacity-75 ">
            <div class="grid w-8/12 grid-cols-3 gap-2 mx-auto">
                @foreach ($presentaciones as $presentacion)
                    <div wire:click="agregar({{ $presentacion->producto->id }},{{ $presentacion->id }})"
                        class="h-10 pt-1 text-center bg-teal-700 border border-gray-600 rounded-md hover:bg-teal-200 hover:text-cool-gray-900 text-cool-gray-50">
                        {{ $presentacion->name }}</div>
                @endforeach
            </div>
        </div>
    @endif



</div>
