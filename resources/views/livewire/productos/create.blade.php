<div>
    <h1 class="titulo_form">
        Registrar producto</h1>

    <form wire:submit.prevent="store()">
        <div class="div-form-container grid grid-cols-1 md:grid-cols-4">

            <div class="px-3 text-left">
                <label class="text-xs text-gray-500 mx-1 " for="">nombre</label>
                <input type="text" placeholder="cañan Cruz campo" name="name" id="name" wire:model="name"
                    class="focus:outline-none focus:shadow-md    focus:bg-gray-100 focus:border-gray-600">
                @error('name')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>
            <div class="px-3 text-left sm:col-span-1 md:col-span-2">
                <label class="text-xs text-gray-500 mx-1 " for="">Descripcion</label>
                <input type="text" wire:model="descrip"
                    placeholder="contenido alcohólico de 5,9% en volumen. De color dorado intenso y aroma afrutado, capaz de transformar los momentos cotidianos en instantes cruciales. Con un amargor moderado y aromático, coronada por una espuma de color blanco roto."
                    name="descrip" id="descrip"
                    class=" focus:outline-none focus:shadow-md    focus:bg-gray-100 focus:border-gray-600">
                @error('descrip')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>
            <div class="px-3 text-left">
                <label class="text-xs text-gray-500 mx-1 " for="">precio de compra</label>
                <input type="number" step="0.01" autocomplete="true" placeholder="1.00" name="p_compra"
                    id="p_compra" wire:model="p_compra"
                    class=" focus:outline-none focus:shadow-md  focus:bg-gray-100 focus:border-gray-600">
                @error('p_compra')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>
            <div class="px-3 text-left">
                <label class="text-xs text-gray-500 mx-1 " for="">precio de venta</label>
                <input type="number" step="0.01" autocomplete="true" placeholder="1.20" name="p_venta"
                    id="p-venta" wire:model="p_venta"
                    class=" focus:outline-none focus:shadow-md   focus:bg-gray-100 focus:border-gray-600">
                @error('p_venta')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>
            <div class="px-3 text-left hidden">
                <label class="text-xs text-gray-500 mx-1 " for="">peso(gramos(g))</label>
                <input type="number" step="0.01" autocomplete="true" placeholder="100" id="peso" name="peso"
                    wire:model="peso"
                    class=" focus:outline-none focus:shadow-md  focus:bg-gray-100 focus:border-gray-600">
                @error('peso')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>
            <div class="px-3 text-left">
                <label class="text-xs text-gray-500 mx-1 " for="">unidad de medida (ml,L,etc)</label>
                <select placeholder="200" value="Ml" id="unidad_medida" name="unidad_medida"
                    wire:model="unidad_medida"
                    class=" focus:outline-none focus:shadow-md  focus:bg-gray-100 focus:border-gray-600">

                    <option value="ml" selected>mililitro (ml)</option>
                    <option value="cl">centilitro (cl)</option>
                    <option value="dl">decilitro (dl)</option>
                    <option value="tapa">tapa (tp)</option>
                    <option value="media">media racion (MR)</option>
                    <option value="media">racion (R)</option>

                </select>
                @error('unidad_medida')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>
            <div class="px-3 text-left ">
                <label class="text-xs text-gray-500 mx-1 " for="">volumen</label>
                <input type="number" step="0.01" autocomplete="true" placeholder="1" id="volumen" name="volumen"
                    wire:model="volumen"
                    class=" focus:outline-none focus:shadow-md  focus:bg-gray-100 focus:border-gray-600">
                @error('volumen')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>
            <div class="px-3">

                <label class="text-xs text-gray-500 mx-1  " for="">Categoria</label>

                <div class=" relative z-30 inline-block text-left dropdown w-full my-1">
                    <span id="btn-dropdown" wire:click="$emit('btn')" class="rounded-md shadow-sm"><button
                            class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800"
                            type="button" aria-haspopup="true" aria-expanded="true"
                            aria-controls="headlessui-menu-items-117">
                            <span>Categoria({{ $nombre_categoria }})</span>
                            <svg class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button></span>
                    <div
                        class=" invisible dropdown-menu  transition-all duration-300 transform origin-top-right -translate-y-2 scale-95">
                        <div class="absolute w-full right-0  mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none"
                            aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117" role="menu">

                            <div class="py-1">

                                @each('livewire.productos.partial', $allcategorias, 'categorias')


                            </div>

                        </div>
                    </div>
                </div>
                <input type="text" wire:model="categorias" class=" hidden ">
                @error('categorias')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>
            <div class="px-3 text-left md:col-span-2">
                <label class="text-xs text-gray-500 mx-1 " for="">imagen</label>
                <div class="subir_foto ">
                    <button
                        class="file_cam">Subir
                        Archivo</button>
                    <input class="imputable " type="file" name="photo" accept="image/png, image/gif, image/jpeg" id="photo"
                        wire:model="photo" />
                    @error('photo')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="px-3 md:m-2 m-1 ">
                @if ($photo)
                    <img class="h-16 mx-auto w-16 object-cover rounded-lg border border-gray-200"
                        src="{{ $photo->temporaryUrl() }}" alt="Current profile photo" />
                @else
                    <img class="h-16 mx-auto w-16 object-cover rounded-lg border border-gray-200"
                        src="{{ asset('images/icons8-cubiertos-100.png') }}" alt="Current profile photo" />
                @endif

            </div>
            <div class="px-3 text-left md:col-span-4">
                <div class="w-auto pl-3 text-center align-middle">
                    <div class="pt-5">
                        <button type="submit"
                            class="px-3 py-2 z-10 bg-indigo-100 text-indigo-500 hover:bg-indigo-500 hover:shadow-lg hover:text-gray-100 rounded">
                            guardar producto</button>

                    </div>
                </div>

            </div>


        </div>
    </form>



</div>
