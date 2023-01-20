<div class=" container mx-auto md:mt-15 mt-1">
    {{-- loading --}}
    <div wire:loading wire:target="selecionar_area,mostrar_comanda,agregar,comandar"
        class="fixed z-40 w-full h-full top-0 left-0 bg-gray-800 bg-opacity-75">
        <div class="w-ful h-full ">
            <div class="flex justify-center h-full">

                <div class="w-24 h-24 my-auto z-50 ">
                    <div role="status">
                        <svg class="animate-spin -ml-1 mr-3 h-18 w-18 text-blue-800" xmlns="http://www.w3.org/2000/svg"
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
    <div class=" w-11/12 mx-auto grid grid-cols-1  gap-5">
        <div class="border border-gray-500">

            @switch($vista_principal)
                @case(1)
                    <div class=" grid gap-5 grid-cols-4 p-2">

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
                    <div class=" grid gap-5 grid-cols-4 p-2">
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
                    <div class=" grid grid-cols-3 gap-0 font-bold  bg-blue-900 text-xs md:text-base text-white">
                        <div class=" col-span-3 text-center text-lg">mesa:{{$mesa_seleccionada->area->name}}-{{ $mesa_seleccionada->nro }}</div>

                        <div class="px-1 text-left">tipo:{{ $mesa_seleccionada->documento->where('estado', '=', 'activa')->first()->tipo }}</div>
                        <div class="px-1 text-center">estado:{{ $mesa_seleccionada->documento->where('estado', '=', 'activa')->first()->estado }}</div>
                        <div class="px-1 text-right">N/S{{ $mesa_seleccionada->documento->where('estado', '=', 'activa')->first()->nro_documento }}
                        </div>
                    </div>
                    <table class="table table-auto w-full ">
                        <tr class=" font-bold bg-blue-900 text-white p-1 text-xs md:text-base">
                            <td>#</td>
                            <td>descripcion</td>
                            {{-- <td class="text-right">P/U</td>
                            <td class="text-right"> total</td> --}}
                            <td>acciones</td>

                        </tr>

                        @foreach ($mesa_seleccionada->documento->where('estado', '=', 'activa')->first()->detalles as $detalle)
                            <tr class="p-1  text-xs md:text-base border-b border-gray-500">

                                <td class="w-auto"> {{ $detalle->cantidad }}</td>
                                <td class="w-auto">{{ $detalle->name }}({{ $detalle->tipo_presentacion }})</td>
                               {{--  <td class="text-right w-10">{{ number_format($detalle->precio_venta, 2, '.', '')  }}</td>
                                <td class="text-right w-10">{{number_format( $detalle->precio_venta * $detalle->cantidad, 2, '.', '')  }}</td> --}}
                                <td>
                                    <div class="flex ">
                                    <i wire:click="disminuir({{$detalle->id}})" class="bi bi-dash bg-red-700 text-white p-1 rounded-sx mr-4 cursor-pointer"></i>
                                    <i wire:click="agregar({{ $detalle->producto->id }},{{ $detalle->producto->presentaciones->where('name','=',$detalle->tipo_presentacion)->first()->id }})" class="bi bi-plus-lg  bg-green-800 text-white p-1 rounded-sx cursor-pointer"></i> 
                                    </div>
                                    
                                    
                                </td>
                                
                            </tr>
                        @endforeach
   {{--                      <tr class="p-1 text-xs md:text-base">
                            
                            <td colspan="3" class=" text-right">Sub total</td>
                            <td class=" text-right">

                                {{ number_format($documento->sub_total, 2, '.', '') }}
                            </td>
                        </tr>
                        <tr class="p-1 text-xs md:text-base">
                            
                            <td colspan="3" class=" text-right">iva 10%</td>
                            <td class=" text-right">
                                {{ number_format($documento->total - $documento->sub_total, 2, '.', '') }}

                            </td>
                        </tr>
                        <tr class="p-1 text-xs md:text-base">

                            
                            <td colspan="3" class=" text-right">Total</td>
                            <td class=" text-right"> {{ number_format($documento->total, 2, '.', '') }}

                            </td>

                        </tr> --}}
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
                <div class="border border-gray-500   grid grid-cols-3  p-2 gap-1  overflow-auto">
                    <div>area</div>
                    <div>nro mesa</div>
                    <div>cantidad</div>
                   
                  
                    @foreach ($all_documentos as $documentos)
                        
                            <div wire:click="mostrar_comanda({{ $documentos->mesa->id }})">{{$documentos->mesa->area->name}}</div>
                            <div>{{$documentos->mesa->nro}}</div>
                            <div>{{$documentos->total}}</div>
                           
                        
                    @endforeach
                </div>
            @break

            @case(2)
                <div class="border border-gray-500   h-96 grid grid-cols-4  p-2 gap-1  overflow-auto">
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

        <x-jet-secondary-button class=" fixed text-center bottom-0 w-full left-0" wire:click="comandar">
            imprimir
        </x-jet-secondary-button>
    </div>
    @if ($presentaciones_view == 1)
        <div class="bg-blue-300 bg-opacity-75 top-0 left-0 fixed w-full flex h-full items-center ">
            <div class="w-8/12 mx-auto grid grid-cols-3 gap-2">
                @foreach ($presentaciones as $presentacion)
                    <div wire:click="agregar({{ $presentacion->producto->id }},{{ $presentacion->id }})"
                        class="h-10 border border-gray-600 hover:bg-teal-200  bg-teal-700 pt-1 text-center rounded-md hover:text-cool-gray-900 text-cool-gray-50">
                        {{ $presentacion->name }}</div>
                @endforeach
            </div>
        </div>
    @endif



</div>
