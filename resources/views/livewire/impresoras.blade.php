<div class="container mx-auto">
<!-- Contenido del contenedor -->
    <div class="container shadow-lg border mt-10 border-gray-300 mx-auto px-4 py-6">
        

        <!-- Botón para crear una nueva impresora -->
        <div class="flex justify-center mb-10">
            <button  wire:click="create" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="bi bi-plus-circle"></i> Nueva impresora
            </button>
        </div>
        <!-- Tabla con la lista de impresoras -->
        <table class="table-auto w-full">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Id</th>
                    <th class="py-3 px-6 text-left">Nombre</th>
                    <th class="py-3 px-6 text-left">Tipo</th>
                    <th class="py-3 px-6 text-left">Predeterminada</th>
                    <th class="py-3 px-6 text-left">Interfaz</th>
                    <th class="py-3 px-6 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach ($impresoras as $impresora)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">{{ $impresora->id }}</td>
                        <td class="py-3 px-6 text-left">{{ $impresora->name }}</td>
                        <td class="py-3 px-6 text-left">{{ $impresora->tipo }}</td>
                        <td class="py-3 px-6 text-left">{{ $impresora->default ? 'Sí' : 'No' }}</td>
                        <td class="py-3 px-6 text-left">{{ $impresora->interface }}</td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center">
                                <a  wire:click="edit({{ $impresora->id }})" href="#" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110"  title="Editar">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <a   wire:click="delete({{ $impresora->id }})" href="#" class="w-4 mr-2  transform hover:text-purple-500 hover:scale-110"  title="eliminar">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                    




                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>




    </div>

    <x-jet-dialog-modal wire:model="isOpen">
        <x-slot name="title">
            {{ $isEditing ? 'Editar impresora' : 'Crear impresora' }}
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Nombre" />
                <x-jet-input type="text" class="block mt-1 w-full" wire:model.defer="name" />
                <x-jet-input-error for="name" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Tipo" />
                <select name="tipo" class="block mt-1 w-full form-select">
                    <option value="EPSON" @if($tipo === 'EPSON') selected @endif>EPSON</option>
                    <option value="STAR" @if($tipo === 'STAR') selected @endif>STAR</option>
                </select>
                <x-jet-input-error for="tipo" />
            </div>
            

            <div class="mb-4">
                <x-jet-label value="Interface" />
                <x-jet-input type="text" class="block mt-1 w-full" wire:model.defer="interface" />
                <x-jet-input-error for="interface" />
            </div>

            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" class="form-checkbox" wire:model.defer="default" />
                    <span class="ml-2 text-sm text-gray-600">Impresora predeterminada</span>
                </label>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                Cancelar
            </x-jet-secondary-button>

            @if ($isEditing)
                <x-jet-danger-button wire:click="update({{ $id_impre }})" wire:loading.attr="disabled">
                    Actualizar
                </x-jet-danger-button>
            @else
                <x-jet-button wire:click="store" wire:loading.attr="disabled">
                    Crear
                </x-jet-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>


</div>
