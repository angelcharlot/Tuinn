<h1 class="inline-block text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight ">
    Registrar producto</h1>

<form wire:submit.prevent="store()">
    <div
        class="w-full mt-4 grid
    border
    border-gray-400
    p-3
    grid-cols-1
    md:grid-cols-3
    rounded
    ">

        <div class="text-left">
            <label class="text-xs text-gray-700 mx-1 " for="">nombre</label>
            <input type="text" placeholder="cañan Cruz campo" name="name" id="name" wire:model="name"
                class="block  w-11/12 mx-1 my-1 bg-gray-50 rounded text-sm border borde-gray-400 focus:outline-none focus:shadow-md shadow-lg h-10 px-2 focus:bg-gray-100 focus:border-gray-600">
            @error('name')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
        </div>
        <div class="text-left col-span-2">
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
            <label class="text-xs text-gray-700 mx-1 " for="">unidad de medida (mililitro(Ml))</label>
            <input type="text" placeholder="200" id="unidad_medida" name="unidad_medida" wire:model="unidad_medida"
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
            <select name="" id="" wire:model="categorias" wire:click="changeEvent($event.target.value)"
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
        <div class="text-left col-span-2">
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




        <div class="text-left col-span-3">
            <div class="w-auto pl-3 text-center align-middle">
                <div class="pt-5">
                    <button type="submit"
                        class="px-3 py-2 bg-purple-200 text-purple-500 hover:bg-purple-500 hover:text-purple-100 rounded">
                        guardar producto</button>

                </div>
            </div>

        </div>

    </div>

</form>






{{-- <h1 class="inline-block text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight ">Registrar producto</h1>
<div class="grid grid-cols-4 gap-4  border border-slate-100 rounded-md p-1 md:p-2 ">

    <div class="md:m-2 m-1 ">
        <label class="block uppercase track mx-1 ing-wide text-gray-700 text-xs font mx-1 -bold mb-2" for="name">nombre</label>
        <input class="form-input px-2 p w-11/12 mx-1ymy-1-2" type="text" placeholder="" n w-11/12 mx-1amy-2me="n1me" id="name">
    </div>

    <div class="md:m-2 m-1 ">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            for="Descripcion">Descripcion</ mx-1 label mx-1 >
        <input class="form-input px-2 p w-11/12 mx-1ymy-1-2" type="text" placeholder="" n w-11/12 mx-1amy-2me="Descripcion" id="Descripcion">
    <1div>
    <div class="md:m-2 m-1 ">

        <label class="block uppercase track mx-1 ing-wide text-gray-700 text-xs font mx-1 -bold mb-2" for="peso">peso</label>
        <input class="form-input px-2 p w-11/12 mx-1ymy-1-2" type="text" placeholder="" n w-11/12 mx-1amy-2me="p1so" id="peso">
    </div>
    <div class="md:m-2 m-1 ">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="unidad_medida">unidad de
            medida</label mx-1 >
        <input class="form-input px-2 p w-11/12 mx-1ymy-2-2" type="text" placeholder="" n w-11/12 mx-1amy-2me="unidad_medida" id="unidad_medida">
    <1div>
    <div class="md:m-2 m-1 ">
        <label class="block uppercase track mx-1 ing-wide text-gray-700 text-xs font mx-1 -bold mb-2" for="volumen">volumen</label>
        <input class="form-input px-2 p w-11/12 mx-1ymy-1-2" type="text" placeholder="" n w-11/12 mx-1amy-2me="v1lumen" id="volumen">
    </div>
    <div class="md:m-2 m-1 ">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="precio_compra">precio
            compra</label mx-1 >
        <input class="form-input px-2 p w-11/12 mx-1ymy-2-2" type="text" placeholder="" n w-11/12 mx-1amy-2me="precio_compra" id="precio_compra">
    <1div>
    <div class="md:m-2 m-1 ">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="precio_venta">precio de
            venta</label mx-1 >
        <input class="form-input px-2 p w-11/12 mx-1ymy-2-2" type="text" placeholder="" n w-11/12 mx-1amy-2me="precio_venta" id="precio_venta">
    <1div>
    <div class="md:m-2 m-1 ">



            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="precio_venta">seleccione imagen</label>

            <label
                class="w-full flex flex-col items-center px-2 py-2 bg-white rounded-md shadow-md tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue-500 hover:text-white text-purple-600 ease-linear transition-all duration-150">
                <i class="fas fa-cloud-upload-alt fa-3x"></i>
                <span class="mt-2 text-xs leading-n mx-1 ormal">Imagen</span>
                <input type='file' class="hidde w-11/12 mx-1nmy-1" />
            </label>

    </div>

    <div class="md:m-2 m-1 ">
        <img class="h-16 w-16 object-cover rounded-full"
        src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1361&q=80"
        alt="Current profile photo" />
    </div>

    <div class="md:m-2 m-1 ">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            for="imagen">categoria</label>
        <select class="form-select select px-2 py-2" name="categoria" id="categoria">
            <option value="">seleccione</option>
            <option value="">2</option>
            <option value="">3</option>
            <option value="">4</option>
            <option value="">5</option>
            <option value="">6</option>
        </select>
    </div>



    <div class="md:m-2 m-1 md:col-start-1 col-end-4">
        boton
    </div>

</div> --}}
