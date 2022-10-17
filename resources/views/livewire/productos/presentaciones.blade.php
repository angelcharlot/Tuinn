<div class="grid grid-cols-7" >
    <div class="px-3 text-left">
        <label class="text-xs text-gray-500 mx-1 " for="">presentacion</label>
        <input type="test" step="0.01" autocomplete="true" value="0" placeholder="1.00" name="presentacion" id="presentacion"
            wire:model="presentaciones.{{ $index }}.name" class=" focus:outline-none focus:shadow-md  focus:bg-gray-100 focus:border-gray-600">
        @error('presentaciones.'.$index.'.name')
            <span class="text-red-500 text-xs italic">{{ $message }}</span>
        @enderror
    </div>
    <div class="px-3 text-left">
        <label class="text-xs text-gray-500 mx-1 " for="">precio de compra</label>
        <input type="number" step="0.01" autocomplete="true" value="0" placeholder="1.00" name="p_compra" id="p_compra"
            wire:model="presentaciones.{{ $index }}.costo" class=" focus:outline-none focus:shadow-md  focus:bg-gray-100 focus:border-gray-600">
        @error('presentaciones.'.$index.'.costo')
            <span class="text-red-500 text-xs italic">{{ $message }}</span>
        @enderror
    </div>
    <div class="px-3 text-left">
        <label class="text-xs text-gray-500 mx-1 " for="">precio de venta</label>
        <input type="number" step="0.01" autocomplete="true" placeholder="1.20" name="p_venta" id="p-venta"
            wire:model="presentaciones.{{ $index }}.precio_venta" class=" focus:outline-none focus:shadow-md   focus:bg-gray-100 focus:border-gray-600">
        @error('presentaciones.'.$index.'.precio_venta')
            <span class="text-red-500 text-xs italic">{{ $message }}</span>
        @enderror
    </div>
    <div class="px-3 text-left ">
        <label class="text-xs text-gray-500 mx-1 " for="">peso(gramos(g))</label>
        <input type="number" step="0.01" autocomplete="true" placeholder="100" id="peso" name="peso"
            wire:model="presentaciones.{{ $index }}.peso" class=" focus:outline-none focus:shadow-md  focus:bg-gray-100 focus:border-gray-600">
        @error('presentaciones.'.$index.'.peso')
            <span class="text-red-500 text-xs italic">{{ $message }}</span>
        @enderror
    </div>
    <div class="px-3 text-left">
        <label class="text-xs text-gray-500 mx-1 " for="">unidad de medida (ml,L,etc)</label>
        <select placeholder="200" value="Ml" id="unidad_medida" name="unidad_medida" wire:model="presentaciones.{{ $index }}.unidad_medida"
            class=" focus:outline-none focus:shadow-md  focus:bg-gray-100 focus:border-gray-600">

            <option value="ml" selected>mililitro (ml)</option>
            <option value="cl">centilitro (cl)</option>
            <option value="dl">decilitro (dl)</option>

        </select>
        @error('presentaciones.'.$index.'.unidad_medida')
            <span class="text-red-500 text-xs italic">{{ $message }}</span>
        @enderror
    </div>
    <div class="px-3 text-left ">
        <label class="text-xs text-gray-500 mx-1 " for="">volumen</label>
        <input type="number" step="0.01" autocomplete="true" placeholder="1" id="volumen" name="volumen"
            wire:model="presentaciones.{{ $index }}.volumen" class=" focus:outline-none focus:shadow-md  focus:bg-gray-100 focus:border-gray-600">
        @error('presentaciones.'.$index.'.volumen')
            <span class="text-red-500 text-xs italic">{{ $message }}</span>
        @enderror
    </div>
    <div class="px-3 text-left block-inline">
        <button type="button" class=" mt-6 focus:outline-none text-white bg-red-300 rounded-lg p-1 hover:bg-red-500">
            delete
        </button>
    </div >


</div>
