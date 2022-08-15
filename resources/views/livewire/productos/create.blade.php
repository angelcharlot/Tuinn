<div>
    <h1 class="inline-block text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight ">
        Registrar producto</h1>
    <div wire:loading wire:target="photo" class="fixed z-40 w-full h-full top-0 left-0 bg-gray-500 bg-opacity-25">
        <div class="w-ful h-full ">
            <div class="flex justify-center h-full">

                <div class="w-6 h-6 my-auto animate-spin bg-gradient-to-r from-blue-900 rounded-full to-blue-500"></div>

            </div>
        </div>
    </div>
    <form wire:submit.prevent="store()">
        <div class="w-full border border-gray-400 p-3 mt-4 rounded grid grid-cols-1  md:grid-cols-3 ">

            <div class="text-left">
                <label class="text-xs text-gray-700 mx-1 " for="">nombre</label>
                <input type="text" placeholder="cañan Cruz campo" name="name" id="name" wire:model="name"
                    class="block  w-11/12 mx-1 my-1 bg-gray-50 rounded text-sm border borde-gray-400 focus:outline-none focus:shadow-md shadow-lg h-10 px-2 focus:bg-gray-100 focus:border-gray-600">
                @error('name')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>
            <div class="text-left sm:col-span-1 md:col-span-2">
                <label class="text-xs text-gray-700 mx-1 " for="">Descripcion</label>
                <input type="text" wire:model="descrip"
                    placeholder="contenido alcohólico de 5,9% en volumen. De color dorado intenso y aroma afrutado, capaz de transformar los momentos cotidianos en instantes cruciales. Con un amargor moderado y aromático, coronada por una espuma de color blanco roto."
                    name="descrip" id="descrip"
                    class="block  w-11/12 mx-1 my-1 bg-gray-50 rounded text-sm border borde-gray-400 focus:outline-none focus:shadow-md shadow-lg h-10 px-2 focus:bg-gray-100 focus:border-gray-600">
                @error('descrip')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>
            <div class="text-left">
                <label class="text-xs text-gray-700 mx-1 " for="">precio de compra</label>
                <input type="num" placeholder="1.00" name="p_compra" id="p_compra" wire:model="p_compra"
                    class="block  w-11/12 mx-1 my-1 bg-gray-50 rounded text-sm border borde-gray-400 focus:outline-none focus:shadow-md shadow-lg h-10 px-2 focus:bg-gray-100 focus:border-gray-600">
                @error('p_compra')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>
            <div class="text-left">
                <label class="text-xs text-gray-700 mx-1 " for="">precio de venta</label>
                <input type="text" placeholder="1.20" name="p_venta" id="p-venta" wire:model="p_venta"
                    class="block  w-11/12 mx-1 my-1 bg-gray-50 rounded text-sm border borde-gray-400 focus:outline-none focus:shadow-md shadow-lg h-10 px-2 focus:bg-gray-100 focus:border-gray-600">
                @error('p_venta')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>
            <div class="text-left">
                <label class="text-xs text-gray-700 mx-1 " for="">peso(gramos(g))</label>
                <input type="text" placeholder="100" id="peso" name="peso" wire:model="peso"
                    class="block  w-11/12 mx-1 my-1 bg-gray-50 rounded text-sm border borde-gray-400 focus:outline-none focus:shadow-md shadow-lg h-10 px-2 focus:bg-gray-100 focus:border-gray-600">
                @error('peso')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>
            <div class="text-left">
                <label class="text-xs text-gray-700 mx-1 " for="">unidad de medida (ml,L,etc)</label>
                <input type="text" placeholder="200" value="Ml" id="unidad_medida" name="unidad_medida"
                    wire:model="unidad_medida"
                    class="block  w-11/12 mx-1 my-1 bg-gray-50 rounded text-sm border borde-gray-400 focus:outline-none focus:shadow-md shadow-lg h-10 px-2 focus:bg-gray-100 focus:border-gray-600">
                @error('unidad_medida')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>
            <div class="text-left">
                <label class="text-xs text-gray-700 mx-1 " for="">volumen(centimetro
                    cubicos(Cm<sub>2</sub>))</label>
                <input type="text" placeholder="1" id="volumen" name="volumen" wire:model="volumen"
                    class="block  w-11/12 mx-1 my-1 bg-gray-50 rounded text-sm border borde-gray-400 focus:outline-none focus:shadow-md shadow-lg h-10 px-2 focus:bg-gray-100 focus:border-gray-600">
                @error('volumen')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label class="text-xs text-gray-700 mx-1 " for="">Categoria</label>
                <select name="" id="" wire:model="categorias"
                    wire:click="changeEvent($event.target.value)"
                    class="block  w-11/12 mx-1 my-1 bg-gray-50 rounded text-sm border borde-gray-400 focus:outline-none focus:shadow-md shadow-lg h-10 px-2 focus:bg-gray-100 focus:border-gray-600">
                    <option value="">seleccione</option>
                    @foreach ($allcategorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                    @endforeach
                </select>
                @error('categorias')
                    <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>
            <div class="text-left md:col-span-2">
                <label class="text-xs text-gray-700 mx-1 " for="">imagen</label>
                <div class="subir_foto">
                    <button
                        class="block  w-11/12 mx-1 my-1 bg-gray-50 rounded text-sm border borde-gray-400 focus:outline-none focus:shadow-md shadow-lg h-10 px-2 focus:bg-gray-100 focus:border-gray-600">Subir
                        Archivo</button>
                    <input type="file" name="photo" id="photo" wire:model="photo" />
                    @error('photo')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="md:m-2 m-1 ">
                @if ($photo)
                    <img class="h-16 mx-auto w-16 object-cover rounded-lg border border-gray-200"
                        src="{{ $photo->temporaryUrl() }}" alt="Current profile photo" />
                @else
                    <img class="h-16 mx-auto w-16 object-cover rounded-lg border border-gray-200"
                        src="{{ asset('images/icons8-cubiertos-100.png') }}" alt="Current profile photo" />
                @endif

            </div>
            <div class="text-left md:col-span-3">
                <div class="w-auto pl-3 text-center align-middle">
                    <div class="pt-5">
                        <button type="submit"
                            class="px-3 py-2 z-10 bg-indigo-200 text-indigo-500 hover:bg-indigo-500 hover:shadow-lg hover:text-gray-100 rounded">
                            guardar producto</button>

                    </div>
                </div>

            </div>


        </div>
    </form>


</div>
