<x-jet-form-section submit="update">
    <x-slot name="title">
        {{ __('datos del local') }}
    </x-slot>

    <x-slot name="description">
        {{ __('modifique los datos de su establecimiento') }}
    </x-slot>


    <x-slot name="form">

        <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4 ">
            <!-- Profile Photo File Input -->
            <input type="file" class="hidden" wire:model="photo" x-ref="photo"
                x-on:change="
                                photoName = $refs.photo.files[0].name;
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    photoPreview = e.target.result;
                                };
                                reader.readAsDataURL($refs.photo.files[0]);
                        " />

            <x-jet-label for="photo" value="Baner" />


                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{asset( $this->negocio->img )}}"  class="rounded-full h-20 w-20 object-cover">
                </div>

            <!-- New Profile Photo Preview -->
            <div class="mt-2" x-show="photoPreview">
                <span class="block rounded-full w-20 h-20"
                    x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' +
                    photoPreview + '\');'">
                </span>
            </div>

            <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                {{ __('Select A New Photo') }}
            </x-jet-secondary-button>

            <x-jet-input-error for="photo" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="nombre del local" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full"  wire:model.defer="name"
                autocomplete="name" />
            <x-jet-input-error for="name" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="direccion" />
            <x-jet-input id="direccion" type="text" class="mt-1 block w-full" wire:model.defer="direccion"
                autocomplete="direccion" />
            <x-jet-input-error for="direccion" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="denominacion social" />
            <x-jet-input id="den_social" type="text" class="mt-1 block w-full" wire:model.defer="den_social"
                autocomplete="den_social" />
            <x-jet-input-error for="den_social" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="telefono1" value="telefono 1" />
            <x-jet-input id="telefono1" type="text" class="mt-1 block w-full" wire:model.defer="telefono1"
                autocomplete="telefono1" />
            <x-jet-input-error for="telefono1" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="telefono 2" />
            <x-jet-input id="telefono2" type="text" class="mt-1 block w-full" wire:model.defer="telefono2"
                autocomplete="telefono2" />
            <x-jet-input-error for="telefono2" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="nif" value="nif" />
            <x-jet-input id="nif" type="text" class="mt-1 block w-full" wire:model.defer="nif"
                autocomplete="nif" />
            <x-jet-input-error for="nif" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="iva" value="iva" />
            <x-jet-input id="iva" type="text" class="mt-1 block w-full" wire:model.defer="iva"
                autocomplete="iva" />
            <x-jet-input-error for="iva" class="mt-2" />
        </div>

    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="update">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>




    </x-jet-action-section>
