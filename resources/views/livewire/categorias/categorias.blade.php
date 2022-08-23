<div class=" min-h-screen mx-auto p-10 w-full md:w-11/12 bg-cool-gray-50 shadow-lg my-5  ">

    {{-- formulario --}}
    @if ($updateMode)
        @include('livewire.categorias.update')
    @else
        @include('livewire.categorias.create')
    @endif

    <div class=" min-h-1/2 mx-auto p-10 w-full md:w-11/12 bg-cool-gray-50 shadow-lg my-5 ">
        <div class="w-full my-4">

            <div class="rounded-t-lg overflow-hidden border-2  border-gray-400 p-4">

                @if ($categoria_seleccionada)

                    <ul class="flex">

                        @foreach ($categoria_seleccionada as $index => $migas)
                            <li class="mr-6">
                                @if($index != count($categoria_seleccionada) - 1)
                                   <a class="text-grey-500 hover:text-blue-800" href="#"> {{ $migas }} <i
                                        class="bi bi-chevron-right"></i></a>
                                @else
                                <a class="text-blue-800 hover:text-blue-800" href="#"> {{ $migas }} <i
                                    class="bi bi-chevron-right"></i></a>

                                @endif

                            </li>
                        @endforeach
                    </ul>

                @endif
            </div>


        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-2 text-gray-600">

            @forelse ($categorias as $categoria)
                <div
                    class="border-2 border-gray-200 min-h-30 rounded-lg shadow-sm bg-white hover:bg-gray-100  divide-y divide-solid ">
                    <div class=" header   grid grid-cols-6 p-3 text-base bg-gray-50">
                        <div class=" text-left col-span-1"><i class="bi bi-bookmarks"></i></div>
                        <div wire:click="buscar({{ $categoria->id }},0)"  class=" text-center col-span-3 font-semibold">{{ $categoria->name }}</div>
                        <div wire:click="delete({{ $categoria->id }})" class=" text-right cols-span-1"><i class="bi bi-x-circle"></i></div>
                        <div wire:click="edit({{ $categoria->id }})" class=" text-right cols-span-1"><i class="bi bi-pencil"></i></div>
                    </div>
                    <div class="p-3 text-xs ">
                        {{ $categoria->descrip }}
                    </div>
                    <div></div>

                </div>

            @empty
                <div>no hay registros</div>
            @endforelse
        </div>
        <div class="mt-5">
            <button wire:click="buscar({{ $id_atras }},1)"
                class="py-2 px-4 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">volver</button>
        </div>

    </div>
    <div wire:loading  wire:target="buscar,update,store"  class="fixed z-40 w-full h-full top-0 left-0 bg-gray-500 bg-opacity-25">
        <div class="w-ful h-full ">
            <div class="flex justify-center h-full">

                <div class="w-24 h-24 my-auto animate-spin ">
                    <img class="w-full h-full" src="{{asset('images/load2.png')}}" alt="">
                </div>

            </div>
        </div>
    </div>
</div>

