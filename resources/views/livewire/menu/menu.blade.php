<div>
    {{-- loading --}}
    <div wire:loading wire:target="idioma,producto"
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

    <div wire:ignore.self class="container mx-auto mt-2 bg-local rounded-md shadow-sm pb-28">
        <div class="grid items-center justify-center grid-cols-6 gap-4 p-4">
            <div class="col-span-2 md:col-span-1">
                <img id="imagen_logo" class="object-cover w-24 h-24 border-4 border-white rounded-full shadow-md"
                    src="{{ asset($negocio->img) }}" alt="">
            </div>
            <div class="col-span-4 md:col-span-5">
                <h2 class="mb-2 text-2xl font-bold text-center text-gray-700 capitalize font-Lobster md:text-left">
                    {{ $negocio->name }}</h2>
            </div>
        </div>

        <div class="w-1/2 m-5">
            <label for="idioma" class="block text-sm font-medium text-gray-700">Idioma</label>
            <div class="relative mt-1">
                <select wire:model.debounce="idioma" id="idioma" name="idioma"
                    class="block w-full pl-3 pr-10 text-base border-gray-300 rounded-md appearance-none focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="es" class="font-bold text-gray-900">Español</option>
                    <option value="en" class="font-bold text-gray-900">Inglés</option>
                    <option value="fr" class="font-bold text-gray-900">Francés</option>
                    <option value="it" class="font-bold text-gray-900">Italiano</option>
                    <option value="de" class="font-bold text-gray-900">Alemán</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>
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
                <ul class="flex flex-wrap gap-2 text-sm text-gray-600">
                    @foreach ($migas as $index => $miga)
                        <li>
                            <a wire:click="nav_categorias('{{ $miga['id'] }}')"
                                class="transition-colors duration-200 hover:text-gray-900 focus:text-gray-900 {{ $index === 0 ? '' : 'flex items-center' }}">
                                {{ $miga['name'] }}
                            </a>
                            @if ($index < count($migas) - 1)
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mx-2 text-gray-400"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M6.707 7.293a1 1 0 0 1 0 1.414L3.414 12l3.293 3.293a1 1 0 1 1-1.414 1.414L2 13.414a1 1 0 0 1 0-1.414L5.293 8.707a1 1 0 0 1 1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </ul>
        </div>
        {{-- selector de categorias --}}

        <div class="container grid w-11/12 max-w-screen-xl grid-cols-4 gap-1 mx-auto mt-2 mb-5">
            @foreach ($categorias as $categoria)
                <button wire:click="nav_categorias('{{ $categoria->id }}')"
                    class="flex items-center justify-center gap-2 p-2 text-xs font-medium text-white bg-blue-500 border border-blue-600 rounded-md shadow-md cursor-pointer hover:bg-indigo-500 hover:border-indigo-600 hover:text-white">
                    <i class="bi bi-filter"></i>
                    <span class=" md:inline-block">{{ $categoria->name }}</span>
                </button>
            @endforeach
        </div>


        {{-- cartas de los productos --}}
        <div wire:change wire:target="idioma"
            class="grid grid-cols-1 gap-3 mx-auto text-xs sm:grid-cols-1 md:grid-cols-1">
            @foreach ($apartados as $apartado)
                {{-- condiciono a que los apartados esten en el filtro --}}
                @if ($productos->where('descrip3', '=', $apartado->descrip3)->where('activo', '=', 1)->count() > 0)
                    <div
                        class="col-span-1 ml-5 text-4xl text-left text-blue-800 sm:col-span-1 md:col-span-1 font-Lobster">
                        {{ $apartado->descrip3 }}
                    </div>
                @endif


                {{-- cartita --}}
                @foreach ($productos->where('descrip3', '=', $apartado->descrip3)->where('activo', '=', 1) as $key => $producto)
                    @php
                        $imagenes = ['morado.png', 'verde.png', 'negro.png', 'rojo.png'];
                        $imagen_actual = $imagenes[$key % count($imagenes)];
                    @endphp
                    <div wire:click.prefetch="producto('{{ $producto->id }}')"
                        class="relative p-2 m-2 rounded-md shadow-md bg-gray-50 hover:shadow-lg hover:bg-gray-100">
                        <div class="relative overflow-hidden rounded-md h-52">
                            <img class="object-cover object-center w-full h-full" src="{{ asset($producto->img) }}"
                                alt="{{ $producto->name }}">
                            <div
                                class="absolute top-0 bottom-0 left-0 z-10 flex justify-center w-full h-full bg-transparent ">
                                {{-- <img class="absolute mascara-carnaval top-2 right-2"
                                    src="{{ asset('storage/banner/' . $imagen_actual) }}" height="45" width="45"
                                    alt="Máscara de carnaval"> --}}
                                <div
                                    class="absolute bottom-0 w-full text-xl font-bold text-center text-white bg-black opacity-50">
                                    {{ $producto->name }}</div>
                            </div>
                        </div>
                        <div class="px-2 py-3">
                            <div class="flex items-center justify-between">
                                <div class="text-lg font-bold text-green-500">
                                    @if (isset($producto->presentaciones))
                                        @foreach ($producto->presentaciones as $presentacion)
                                            <div class="mb-1">{{ $presentacion->name }}:
                                                &euro;{{ $presentacion->precio_venta }}</div>
                                        @endforeach
                                    @else
                                        &euro;{{ $producto->precio_venta }}
                                    @endif
                                </div>
                                <div class="flex items-center">
                                    <div class="mr-2 text-gray-600">
                                        {{ $producto->likes->where('tipo', 1)->count() }}
                                        <i class="bi bi-heart-fill"></i>
                                    </div>
                                    <div class="text-gray-600">
                                        {{ $producto->likes->where('tipo', 0)->count() }}
                                        <i class="bi bi-heartbreak-fill"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2 text-sm text-gray-600">
                                @if ($idioma != 'es')
                                    @foreach ($producto->idiomas->where('idioma', '=', $idioma) as $idioma_select)
                                        {{ $idioma_select->descrip }}
                                    @endforeach
                                @else
                                    {{ $producto->descrip }}
                                @endif
                            </div>
                            <div class="mt-2">
                                @foreach ($producto->categorias as $categoria)
                                    <span
                                        class="inline-block px-2 py-1 mr-2 text-xs font-semibold text-gray-700 bg-gray-200 rounded-full">#{{ $categoria->name }}</span>
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
        class="fixed bottom-0 z-50 grid w-full grid-cols-3 p-2 mx-auto text-xs text-white bg-black border-t-2 border-black-300">
        <div>
            <div class="w-full text-left">
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
        <div class="flex flex-col items-end justify-center px-4">
            <a href="whatsapp://send?text=https://tuinn.es/menu/1"
                class="flex items-center justify-center px-4 py-2 font-semibold text-white bg-green-500 rounded-lg focus:outline-none focus:shadow-outline-green hover:bg-green-600">
                <span class="text-xl text-white bi bi-whatsapp"></span>
            </a>
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
            <div class="justify-center w-full mx-auto h-52 md:h-48">
                <img class="w-auto h-full mx-auto" src="{{ asset($producto_selecionado->img) }}" alt="Sunset">
            </div>
            
            @foreach ($producto_selecionado->presentaciones as $presentacion)
                <div class="w-5/6 mx-auto "
                    style="letter-spacing: -0.044em;font-weight: 600;font-size: 21px;font-style: italic;">
                    {{ $presentacion->name }} &euro; {{ $presentacion->precio_venta }}
                </div>
            @endforeach

            <div class="w-full mx-auto mt-1 text-base font-bold ">descripcion:</div>
            <div class="w-full p-2 mx-auto overflow-auto text-base text-justify text-gray-700 max-h-40">

                @if ($idioma != 'es')
                    @foreach ($producto_selecionado->idiomas->where('idioma', '=', $idioma) as $idioma_select)
                        {{ $idioma_select->descrip }}
                    @endforeach
                @else
                    {{ $producto_selecionado->descrip }}
                @endif



            </div>
            @if ($producto_selecionado->descrip2)
                <div class="w-full mx-auto mt-1 text-xs font-bold ">Maridaje:</div>
                <div class="w-full mx-auto overflow-auto text-xs text-justify text-gray-700">
                    @if ($idioma != 'es')
                        @foreach ($producto_selecionado->idiomas->where('idioma', '=', $idioma) as $idioma_select)
                            {{ $idioma_select->descrip2 }}
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
    {{-- modal de los mensajes --}}
    <x-jet-dialog-modal wire:model="modalVisible">
        <x-slot name="title">
            <h1 class="w-full text-lg text-center font-Lobster">¡Celebra la Semana Santa con nosotros!</h1>
        </x-slot>

        <x-slot name="content">
            <div class="relative h-96">
                <img class="absolute top-0 left-0 w-full h-full " src="{{ asset('storage/banner/mensaje.png') }}"
                    alt="Imagen de fondo del modal">
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="text-center">
                        <h1 class="text-xl font-bold text-black font-Lobster">{{ $negocio->name }}</h1>
                        <p class="mt-2 text-lg text-justify text-gray-700 font-Lobster">"Les deseamos una feliz Semana
                            Santa, disfrutando de nuestras tapas, platos y sugerencias gastronómicas."</p>
                    </div>
                </div>
                {{--   <img class="absolute top-0 left-0 w-full h-full "
                src="{{ asset('storage/banner/vela.png') }}"
                     alt="Imagen de fondo del modal"> --}}

            </div>
        </x-slot>

        <x-slot name="footer">
            <!-- Botones del pie de página del modal -->
            <x-jet-secondary-button wire:click="$set('modalVisible',false)" wire:loading.attr="disabled">
                Cerrar
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
