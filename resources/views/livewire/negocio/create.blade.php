<div class="w-full">
    <h1 class="inline-block text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight ">
        Registrar empleado</h1>

    <div class="w-full border border-gray-400 p-3 mt-4 rounded grid   grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-2">
        {{-- nombre --}}
        <div class="w-auto px-3">
            <label class="text-xs text-gray-700 mx-1 " for="name">Nombre</label>
            <input
                class="block  w-11/12 mx-1 my-1 bg-gray-50 rounded text-sm border borde-gray-400 focus:outline-none focus:shadow-md shadow-lg h-10 px-2 focus:bg-gray-100 focus:border-gray-600"
                id="name" wire:model="name" type="text" placeholder="Nombre completo...">
            @error('name')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
        </div>
        {{-- email --}}
        <div class="w-auto px-3">
            <label class="text-xs text-gray-700 mx-1 " for="email">Email</label>
            <input
                class="block  w-11/12 mx-1 my-1 bg-gray-50 rounded text-sm border borde-gray-400 focus:outline-none focus:shadow-md shadow-lg h-10 px-2 focus:bg-gray-100 focus:border-gray-600"
                id="email" wire:model="email" type="text" placeholder="Correo electrónico...">
            @error('email')
                <span class="text-red-500 text-xs italic py-1">{{ $message }}</span>
            @enderror
        </div>
        {{-- passwork --}}
        <div class="w-auto px-3">
            <label class="text-xs text-gray-700 mx-1 " for="email">password</label>
            <input
                class="block  w-11/12 mx-1 my-1 bg-gray-50 rounded text-sm border borde-gray-400 focus:outline-none focus:shadow-md shadow-lg h-10 px-2 focus:bg-gray-100 focus:border-gray-600"
                id="password" wire:model="password" type="text" placeholder="password">
            @error('password')
                <span class="text-red-500 text-xs italic py-1">{{ $message }}</span>
            @enderror
        </div>
        {{-- rol --}}
        <div class="w-auto px-3" wire:ignore>
            <label class="text-xs text-gray-700 mx-1 " for="email">rol</label>
            <select
                class="block  w-11/12 mx-1 my-1 bg-gray-50 rounded text-sm border borde-gray-400 focus:outline-none focus:shadow-md shadow-lg h-10 px-2 focus:bg-gray-100 focus:border-gray-600"
                id="rol" wire:model="rol" wire:click="changeEvent($event.target.value)" type="text"
                placeholder="rol ...">
                <option value="" selected="true">seleccione </option>
                <option value="camarero">camarero</option>
                <option value="cocinero">cocinero</option>
            </select>
            @error('rol')
                <span class="text-red-500 text-xs italic py-1">{{ $message }}</span>
            @enderror
        </div>
        <div class="w-auto pl-3 text-center align-middle col-span-1 md:col-span-4 sm:grid-cols-2">
            <div class="pt-5">
                <button wire:click="store()"
                    class="px-3 py-2 bg-indigo-200 text-indigo-500 hover:bg-indigo-500 hover:text-indigo-100 rounded">Agregar
                    empleado</button>
            </div>
        </div>


    </div>

</div>

