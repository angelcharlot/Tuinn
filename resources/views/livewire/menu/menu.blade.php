<div class="  ">
    {{-- loading --}}
    <div wire:loading wire:target="idioma" class="fixed z-40 w-full h-full top-0 left-0 bg-gray-800 bg-opacity-75">
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

  

    <div class=" bg-whitem mb-10 h-min-96 my-10 container mx-auto rounded-md shadow-sm ">
        
        <div class="w-full my-3 grid grid-cols-6 md:grid-cols-12 border-b-8 border-blue-500 gap-1">
            {{--1  imagen del negocio --}}
            <div class="  col-span-2 md:col-span-1 mx-auto  flex items-center">
                    <img class="object-scale-down  h-20 rounded-full" src="{{ asset($negocio->img) }}" alt="">
            </div>
            {{--2  nombre del negocio --}}
            <div class=" col-span-4 md:col-span-9 mx-auto  " >
                <div class="text-center font-Lobster   mt-3 text-4xl text-gray-700 font-bold">{{ $negocio->name }}</div>
               
            </div>
            {{--3  datos del negocio --}}
            <div class=" col-span-6 md:col-span-2 mx-auto  items-center">
                <div class="w-full text-left text-md font-bold">{{ $negocio->direccion }}</div>
                <div class="text-left mb-3 text-xs font-bold">{{ $negocio->nif }}</div>
            </div>
           

           
        </div>
  
        <div class=" w-4/12  m-5">
        <label class="text-xs text-gray-500 mx-1 " for="">Idioma</label>
            <select wire:model='idioma' class=" rounded-lg " name="" id="">
                <option value="es">español</option>
                <option value="en">Inglés</option>
                <option value="fr">Francés</option>
                <option value="it">Italiano</option>
                <option value="de">Alemán</option>
                <option value="ca">catalan</option>
            </select>
        </div>
        <div
            class=" border-gray-200 container w-11/12 mx-auto  border border-light shadow-card  py-1 px-2 sm:px-6 md:px-8 md:py-2 ">

            <ul class="flex items-center">
                {{-- miga home --}}
                <li class="flex items-center">
                    <a wire:click="nav_categorias('principal')"
                        class="font-semibold text-2xl text-blue-800 hover:text-blue-500  cursor-pointer hover:text-primary">
                        <i class="bi bi-house-door"></i> </a>
                    @if (count($migas) > 0)
                        <span class="px-3">
                            <i class="bi bi-chevron-right"></i>
                        </span>
                    @endif
                </li>
                {{-- migas --}}
                @foreach ($migas as $index => $miga)
                    @if ($index != count($migas) - 1)
                        <li class="flex items-center">

                            <a wire:click="nav_categorias('{{ $miga['id'] }}')"
                                class="font-semibold hover:text-blue-800 cursor-pointer text-base text-black hover:text-primary">
                                {{ $miga['name'] }}
                            </a>

                            <span class="px-3">
                                <i class="bi bi-chevron-right"></i>
                            </span>

                        </li>
                    @else
                        <li class="flex items-center">

                            <a wire:click="nav_categorias('{{ $miga['id'] }}')"
                                class="font-semibold text-base text-blue-800  border-b-4 border-blue-800  hover:text-primary">
                                {{ $miga['name'] }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
        {{-- selector de categorias --}}

        <div class=" container w-11/12 h-10 mx-auto mt-2 grid grid-cols-4 gap-1 mb-5">
            @foreach ($categorias as $categoria)
                <div wire:click="nav_categorias('{{ $categoria->id }}')"
                    class=" cursor-pointer rounded-md hover:bg-blue-500 text-white  bg-blue-600 border-blue-800 border-b-4 text-center py-1">
                    {{ $categoria->name }}
                </div>
            @endforeach
        </div>

        {{-- cartas de los productos --}}
        <div class=" grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-3 text-xs mx-auto">
            @foreach ($productos as $producto)
                
                <div wire:click="producto('{{ $producto->id }}')"
                    class=" grid-cols-2 grid border border-gray-200 m-1 rounded-md shadow-xs p-1 hover:border-indigo-300 hover:shadow-2xl ">
                    <div class="col-span-2 text-center font-extrabold" >{{ $producto->name }} </div>
                    <div><img class="h-full object-scale-down rounded-md" src="{{ asset($producto->img) }}"
                            alt="Sunset in the mountains">
                    </div>
                    <div>
                        <table class="w-full ">
                            <tbody>
                               
                                @if (isset($producto->presentaciones))
                                    @foreach ($producto->presentaciones as $presentacion)
                                        <tr class="">
                                            <td class="pl-2 text-green-900 text-xs font-medium ">
                                                {{ $presentacion->name }}: &euro;{{ $presentacion->precio_venta }}
                                            </td>

                                        </tr>
                                    @endforeach
                                @else
                                <tr class="">
                                    <td class="pl-2 text-green-900 text-2xl font-medium ">
                                        &euro;{{ $producto->precio_venta }}
                                    </td>

                                </tr>
                                @endif


                            </tbody>
                        </table>

                    </div>
                    <div class="col-span-2 text-ellipsis overflow-hidden h-10  ">
                        {{ $producto->descrip }}
                    </div>
                    <div class="col-span-2  flex items-center ">

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



    </div>
    {{-- modal de los productos --}}
    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            <div class="grid grid-cols-6">
                <div class=" col-span-5 "
                    style="font-size: 22px;line-height: 25px;letter-spacing: 0.042em;font-weight: 697;">
                    {{ $producto_selecionado->name }}
                </div>
                <div wire:click="$set('open',false)"
                    class=" col-span-1 text-right text-red-800 font-bold cursor-pointer ">
                    <i class="bi bi-x-lg"></i>
                </div>
            </div>

        </x-slot>
        <x-slot name="content">
            <div class="justify-center h-48 w-5/6 mx-auto mb-5 ">
                <img class=" h-full object-scale-down mx-auto " src="{{ asset($producto_selecionado->img) }}"
                    alt="Sunset">
            </div>
            @foreach ($producto_selecionado->presentaciones as $presentacion)
                <div class="  w-5/6 mx-auto mt-2"
                style="letter-spacing: -0.044em;font-weight: 600;font-size: 21px;font-style: italic;">
                 {{$presentacion->name}} &euro; {{ $presentacion->precio_venta }}
            </div> 
            @endforeach
           
            <div class=" mt-5 w-5/6 mx-auto text-lg font-bold">descripcion:</div>
            <div class="  w-5/6 mx-auto h-40 p-5 overflow-auto text-base text-gray-400 text-justify">
                {{ $producto_selecionado->descrip }}
            </div>
        </x-slot>
        <x-slot name="footer">
            <div class="">
                @foreach ($producto_selecionado->categorias as $categoria)
                    <span
                        class="inline-block bg-gray-200 rounded-full px-1 py-1  font-semibold text-gray-700 mr-2 mb-2">#{{ $categoria->name }}</span>
                @endforeach
            </div>
        </x-slot>

    </x-jet-dialog-modal>

</div>
