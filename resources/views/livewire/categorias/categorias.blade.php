<div class="hoja_base">

    {{-- formulario --}}
    @if ($updateMode)
        @include('livewire.categorias.update')
    @else
        @include('livewire.categorias.create')
    @endif

    <div class=" shadow-sm overflow-hidden my-8 ">
        <div class="bg-white mb-5 rounded-lg shadow-md">
            <div class="border-t border-gray-400">
                <div class="py-3 px-4 flex items-center justify-between bg-white">
                  <div class="flex items-center space-x-2">
                    @if ($categoria_seleccionada)
                      @foreach ($categoria_seleccionada as $index => $migas)
                        <div class="text-gray-400 text-sm">
                          @if ($index != count($categoria_seleccionada) - 1)
                            <a href="#" class="hover:text-gray-700">{{ $migas }}</a>
                          @else
                            <span>{{ $migas }}</span>
                          @endif
                        </div>
                        <div class="text-gray-400 text-xs">
                          @if ($index != count($categoria_seleccionada) - 1)
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 inline-block">
                              <path d="M3.707 3.293a1 1 0 0 0-1.414 0L.293 5.586A1 1 0 0 0 1.707 7l2-2a1 1 0 0 0 0-1.414z"/>
                            </svg>
                          @endif
                        </div>
                      @endforeach
                    @endif
                  </div>
                </div>
              </div>
              
        </div>

        <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-1 text-gray-600">

            @forelse ($categorias as $categoria)
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg hover:bg-gray-50 overflow-hidden">
                <div class="p-4">
                    <div class="font-semibold text-xl">{{ $categoria->name }}</div>
                    <div class="h-20 overflow-hidden text-sm text-gray-500">{{ $categoria->descrip }}</div>
                </div>
                <div class="flex justify-between items-center px-4 py-2 bg-gray-100">
                    <div wire:click="$emit('borrar',{{ $categoria->id }})" class="text-red-500 hover:text-white hover:bg-red-500 rounded-md p-2">
                        <i class="bi bi-x-circle"></i>
                    </div>
                    <div wire:click="edit({{ $categoria->id }})" class="text-indigo-500 hover:text-white hover:bg-indigo-500 rounded-md p-2">
                        <i class="bi bi-pencil"></i>
                    </div>
                </div>
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
    

        {{-- loading --}}
        <div wire:loading wire:target="buscar,update,store"
        class="fixed z-40 w-full h-full top-0 left-0 bg-gray-500 bg-opacity-25">
        <div class="w-ful h-full ">
            <div class="flex justify-center h-full">

                <div class="w-24 h-24 my-auto ">
                    <div role="status">
                        <svg class="animate-spin -ml-1 mr-3 h-18 w-18 text-blue-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                          </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

