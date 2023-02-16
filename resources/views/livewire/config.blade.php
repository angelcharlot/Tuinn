<x-jet-form-section submit="update">
    <x-slot name="title">
        {{ __('datos de conexion a impresoras') }}
    </x-slot>

    <x-slot name="description">
        {{ __('host controlador de impresoras, consulte a su tecnico para mas informacion') }}
    </x-slot>


    <x-slot name="form">


        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="host" value="Host" />
            <x-jet-input id="host" type="text" class="block w-full mt-1"  wire:model.defer="host"
                autocomplete="http://" />
            <x-jet-input-error for="host" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="port" value="Port" />
            <x-jet-input id="port" type="text" class="block w-full mt-1" wire:model.defer="port"
                autocomplete="8080" />
            <x-jet-input-error for="direccion" class="mt-2" />
        </div>
        
       

    </x-slot>

    <x-slot name="actions">
        <div class="w-full text-left">
            @if ($bn==1)
                <h1 class="text-green-500">
                     {{$test}}
                </h1>
            @else
                <h1 class="text-red-500">
                    {{$test}}
            </h1>
            @endif
           
        
        </div>
        <x-jet-action-message class="mr-3" on="update">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="update">
            {{ __('Save') }}
        </x-jet-button>
       
    </x-slot>




    </x-jet-action-section>
