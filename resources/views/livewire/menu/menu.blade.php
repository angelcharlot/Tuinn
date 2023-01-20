<div class="bg-teal-300 ">
    {{-- loading --}}
    <div wire:loading wire:target="idioma,producto" class="fixed top-0 left-0 z-40 w-full h-full bg-gray-800 bg-opacity-75">
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

    <div  wire:ignore.self class="container mx-auto mt-2 bg-local rounded-md shadow-sm pb-28">
        {{-- DATOS DEL NEGOCIO --}}
        <div class="grid w-full grid-cols-6 gap-1 my-3 md:grid-cols-12">
            {{-- 1  imagen del negocio --}}
            <div class="flex items-center col-span-2 mx-auto md:col-span-1">
                <img id="imagen_logo" class="object-scale-down h-20 rounded-full" src="{{ asset($negocio->img) }}" alt="">
            </div>
            {{-- 2  nombre del negocio --}}
            <div class="col-span-4 mx-auto md:col-span-9">
                <div class="mt-3 text-2xl font-bold text-center text-gray-700 font-Lobster md:text-4xl">
                    {{ $negocio->name }}
                </div>
            </div>
        </div>

        <div class="w-4/12 m-5 ">
            {{-- idioma --}}
            <label class="mx-1 text-xs text-gray-500 " for="">Idioma</label>
            <select wire:model.debounce="idioma"   class="rounded-lg " >
                <option value="es">español</option>
                <option value="en">Inglés</option>
                <option value="fr">Francés</option>
                <option value="it">Italiano</option>
                <option value="de">Alemán</option>

            </select>
        </div>
        <div
            class="container w-11/12 px-2 py-1 mx-auto border-b border-gray-200 border-light shadow-card sm:px-6 md:px-8 md:py-2">
            <ul class="flex items-center">
                {{-- miga home --}}
                <li class="flex items-center">
                    <a wire:click="nav_categorias('principal')"
                        class="text-2xl font-semibold text-blue-800 cursor-pointer hover:text-blue-500 hover:text-primary">
                        <i class="bi bi-filter-circle"></i>
                    </a>
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
                                class="text-base font-semibold text-black cursor-pointer hover:text-blue-800 hover:text-primary">
                                {{ $miga['name'] }}
                            </a>

                            <span class="px-3">
                                <i class="bi bi-chevron-right"></i>
                            </span>

                        </li>
                    @else
                        <li class="flex items-center">

                            <a wire:click="nav_categorias('{{ $miga['id'] }}')"
                                class="text-base font-semibold text-blue-800 border-b-4 border-blue-800 hover:text-primary">
                                {{ $miga['name'] }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
        {{-- selector de categorias --}}

        <div class="container grid w-11/12 h-10 grid-cols-4 gap-1 mx-auto mt-2 mb-5 ">
            @foreach ($categorias as $categoria)
                <div wire:click="nav_categorias('{{ $categoria->id }}')"
                    class="flex items-center font-medium text-gray-100 bg-blue-500 border-b border-blue-600 rounded-md shadow-md cursor-pointer hover:bg-blue-500 ">
                    <h1 class="w-full text-xs text-center capitalize md:text-base ">{{ $categoria->name }}</h1>

                </div>
            @endforeach
        </div>

        {{-- cartas de los productos --}}
        <div wire:change wire:target="idioma" class="grid grid-cols-2 gap-3 mx-auto text-xs sm:grid-cols-4 md:grid-cols-6">
            @foreach ($apartados as $apartado)
            {{--condiciono a que los apartados esten en el filtro--}}
                @if ($productos->where('descrip3', '=', $apartado->descrip3)->where('activo','=',1)->count() > 0)
                    <div class="col-span-2 ml-5 text-4xl text-left text-blue-800 sm:col-span-4 md:col-span-6 font-Lobster">
                         {{ $apartado->descrip3 }}
                </div>
                @endif

           
                {{-- cartita --}}
                @foreach ($productos->where('descrip3', '=', $apartado->descrip3)->where('activo','=',1) as $key => $producto)
                    
                    <div wire:click.prefetch="producto('{{ $producto->id }}')"
                        class="relative grid grid-cols-2 p-1 m-1 bg-white border border-gray-200 rounded-md shadow-xs hover:border-indigo-300 hover:shadow-2xl">
                        
                        <div class="absolute sombrero">
                           @if (($key  % 2) == 0)
                               <img src="{{asset('storage/banner/carnaval.png')}}" alt="">
                            @else
                            <img src="{{asset('storage/banner/carnaval2.png')}}" alt="">
                           @endif
                            
                        </div>
                        
                        <div class="col-span-2 font-extrabold text-center">
                            {{ $producto->name }}
                        </div>
                        <div>
                            <img class="object-fill h-24 rounded-md " src="{{ asset($producto->img) }}"
                                alt="Sunset in the mountains">
                        </div>
                        <div>
                            <table class="w-full">
                                <tbody>

                                    @if (isset($producto->presentaciones))
                                        @foreach ($producto->presentaciones as $presentacion)
                                            <tr>
                                                <td class="pl-2 text-xs font-medium text-green-900 ">
                                                    {{ $presentacion->name }}: &euro;{{ $presentacion->precio_venta }}
                                                </td>

                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="pl-2 text-2xl font-medium text-green-900 ">
                                                &euro;{{ $producto->precio_venta }}
                                            </td>

                                        </tr>
                                    @endif


                                </tbody>
                            </table>

                        </div>
                        <div class="h-10 col-span-2 overflow-hidden text-ellipsis ">
                            @if ($idioma!="es")
                            @foreach ($producto->idiomas->where('idioma','=',$idioma) as $idioma_select)
                                {{$idioma_select->descrip}}
                            @endforeach
                            @else   
                            {{ $producto->descrip }}
                            @endif
                            
                        </div>
                        <div class="grid grid-cols-2 col-span-2">
                            <div>
                                {{ $producto->likes->where('tipo', 1)->count() }}
                                <i class="mx-auto text-red-800 bi bi-heart-fill"></i>
                            </div>
                            <div>
                                {{ $producto->likes->where('tipo', 0)->count() }}
                                <i class="mx-auto bi bi-heartbreak-fill "></i>
                            </div>
                        </div>
                        <div class="col-span-2">

                            <div class="w-full">
                                @foreach ($producto->categorias as $categoria)
                                    <span
                                        style="font-size: 8px;line-height: 11px;letter-spacing: 0.027em;font-weight: 875;"
                                        class="inline-block px-1 py-1 mb-2 mr-2 font-semibold text-gray-700 bg-gray-200 rounded-full">#{{ $categoria->name }}</span>
                                @endforeach
                            </div>

                        </div>
                    </div>
                @endforeach
            @endforeach

        </div>



    </div>
    {{-- 3  datos del negocio --}}
    <div
        class="fixed bottom-0 grid w-full grid-cols-3 p-2 mx-auto text-sm text-white bg-black border-t-2 border-indigo-300 ">
        <div>
            <div class="w-full text-sm text-left">
                Direccion: {{ $negocio->direccion }}
            </div>
        </div>
        <div>
            <div class="text-xs font-bold text-left">
                Tlf:{{ $negocio->telefono1 }}
            </div>
            <div class="mb-2 text-xs font-bold text-left">
                Tlf:{{ $negocio->telefono2 }}
            </div>
        </div>
        <div>
          <a href="whatsapp://send?text=https://tuinn.es/menu/1">Compartir <i class="bi bi-whatsapp"></i></a>  
        </div>
        <div class="col-span-3 mx-auto text-xs">
            designer by ING. Angel Charlot, olvera cadiz
        </div>

    </div>
    {{-- modal de los productos --}}
    <x-jet-dialog-modal wire:model.debounce="open">
        <x-slot name="title">
            <div class="grid grid-cols-6">
                <div class="col-span-5 "
                    style="font-size: 22px;line-height: 25px;letter-spacing: 0.042em;font-weight: 697;">
                    {{ $producto_selecionado->name }}
                </div>
                <div wire:click="$set('open',false)"
                    class="col-span-1 font-bold text-right text-red-800 cursor-pointer ">
                    <i class="bi bi-x-lg"></i>
                </div>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="justify-center w-5/6 mx-auto h-36 md:h-48 ">
                <img class="object-scale-down h-full mx-auto " src="{{ asset($producto_selecionado->img) }}"
                    alt="Sunset">
            </div>
            @foreach ($producto_selecionado->presentaciones as $presentacion)
                <div class="w-5/6 mx-auto "
                    style="letter-spacing: -0.044em;font-weight: 600;font-size: 21px;font-style: italic;">
                    {{ $presentacion->name }} &euro; {{ $presentacion->precio_venta }}
                </div>
            @endforeach

            <div class="w-full mx-auto mt-1 text-base font-bold ">descripcion:</div>
            <div class="w-full p-2 mx-auto overflow-auto text-base text-justify text-gray-700 max-h-40">

                @if ($idioma!="es")
                @foreach ($producto_selecionado->idiomas->where('idioma','=',$idioma) as $idioma_select)
                    {{$idioma_select->descrip}}
                @endforeach
                @else   
                {{ $producto_selecionado->descrip }}
                @endif


               
            </div>
            @if ($producto_selecionado->descrip2)
                <div class="w-full mx-auto mt-1 text-xs font-bold ">Maridaje:</div>
                <div class="w-full mx-auto overflow-auto text-xs text-justify text-gray-700">
                    @if ($idioma!="es")
                    @foreach ($producto_selecionado->idiomas->where('idioma','=',$idioma) as $idioma_select)
                        {{$idioma_select->descrip2}}
                    @endforeach
                    @else   
                    {{ $producto_selecionado->descrip2 }}
                    @endif



                   
                </div>
            @endif

            <div class="w-full p-3 ml-5 text-left">
                @foreach ($producto_selecionado->alargenos as $alargeno)
                    <img class="inline w-auto h-10" src="{{ asset($alargeno->img) }}" alt="{{ $alargeno->name }}">
                @endforeach


            </div>
        </x-slot>
        <x-slot name="footer">

            <div class="flex items-center justify-between">
                <div>
                    <x-jet-button wire:click="$set('open',false)">cerrar</x-jet-button>
                </div>

                <div class="flex justify-between w-3/4 p-2">

                    <div wire:click="likes(0,'{{ $producto_selecionado->id }}')"
                        class="bg-red-200 rounded-md hover:bg-red-100">

                        <i class="p-3 mx-auto text-lg text-red-700 cursor-pointer bi bi-hand-thumbs-down"></i>
                    </div>

                    <div wire:click="likes(1,'{{ $producto_selecionado->id }}')"
                        class="bg-green-200 rounded-md hover:bg-green-100">

                        <i class="p-3 mx-auto text-lg text-green-700 rounded-md cursor-pointer bi bi-hand-thumbs-up">
                        </i>
                    </div>
                </div>

            </div>
        </x-slot>
    </x-jet-dialog-modal>

</div>
