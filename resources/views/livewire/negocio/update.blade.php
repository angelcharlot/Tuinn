<div class="w-full">
   <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-2 flex flex-wrap justify-between items-center mb-5">
        {{-- nombre --}}
        <div class="w-auto pr-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">Nombre</label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border {{ $errors->has('name') ? ' border-red-500' : 'border-gray-200' }} rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" id="name" wire:model="name" type="text" placeholder="Nombre completo...">
            @error('name')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
            @enderror
        </div>
         {{-- email --}}
        <div class="w-auto px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">Email</label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border {{ $errors->has('name') ? ' border-red-500' : 'border-gray-200' }} rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="email" wire:model="email" type="text" placeholder="Correo electrónico...">
            @error('email')
                <span class="text-red-500 text-xs italic py-1">{{ $message }}</span>
            @enderror
        </div>
         {{-- passwork --}}
        <div class="w-auto px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">password</label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border {{ $errors->has('name') ? ' border-red-500' : 'border-gray-200' }} rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="password" wire:model="password" type="text" placeholder="password">
            @error('password')
                <span class="text-red-500 text-xs italic py-1">{{ $message }}</span>
            @enderror
        </div>
        {{-- rol --}}
        <div class="w-auto px-3" wire:ignore>
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">rol</label>
            <select class="appearance-none block w-full bg-gray-200 text-gray-700 border {{ $errors->has('name') ? ' border-red-500' : 'border-gray-200' }} rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="rol" wire:model="rol" wire:click="changeEvent($event.target.value)" type="text" placeholder="rol ...">
                <option value="" selected="true">seleccione </option>
                <option value="camarero" >camarero</option>
                <option value="cocinero">cocinero</option>
            </select>
            @error('rol')
                <span class="text-red-500 text-xs italic py-1">{{ $message }}</span>
            @enderror
        </div>
   






    </div>
                <div class="w-auto pl-3 text-center align-middle">
            <div class="pt-5">
               <button wire:click="update()" class="px-3 py-2 bg-orange-200 text-orange-500 hover:bg-orange-500 hover:text-orange-100 rounded">Actualizar contacto</button>
            </div>
        </div>
</div>
@push('scripts')

<script>

    $(document).ready(function() {

        $('.rol').select2();

    });

</script>

@endpush