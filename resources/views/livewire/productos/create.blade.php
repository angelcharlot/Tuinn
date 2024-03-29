<div>
    <h1 class="titulo_form">
        Registrar producto</h1>
    {{-- formularios --}}
    <form wire:submit.prevent="store()">
        <div class="grid grid-cols-1 div-form-container md:grid-cols-3">
            <div class="px-3 text-left">
                <label class="mx-1 text-xs text-gray-500 " for="">nombre</label>
                <input type="text" placeholder="cañan Cruz campo" wire:model.defer="name"
                    class="focus:outline-none focus:shadow-md focus:bg-gray-100 focus:border-gray-600">
                @error('name')
                    <span class="text-xs italic text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="px-3 text-left">

                <label class="mx-1 text-xs text-gray-500 " for="">alergenos</label>
                <select wire:model.defer="alargenos" id="alargenos" name="alargenos" multiple>
                    @foreach ($allalargenos as $alargeno)
                        <option value='{{ $alargeno->id }}'>{{ $alargeno->name }}</option>
                    @endforeach
                </select>
                @error('alargenos')
                    <span class="text-xs italic text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="px-3">

                <label class="mx-1 text-xs text-gray-500 " for="">Categoria</label>

                <div class="relative z-30 inline-block w-full my-1 text-left dropdown">
                    <span wire:click="$emit('btn')" class="rounded-md shadow-sm"><button
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
                        class="invisible transition-all duration-300 origin-top-right transform scale-95 -translate-y-2 dropdown-menu">
                        <div class="absolute right-0 w-full mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none"
                            aria-labelledby="headlessui-menu-button-1" -items-117" role="menu">

                            <div class="py-1">

                                @each('livewire.productos.partial', $allcategorias, 'categorias')


                            </div>

                        </div>
                    </div>
                </div>
                <input type="text" wire:model.defer="categorias" class="hidden ">
                @error('categorias')
                    <span class="text-xs italic text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="items-center px-3 text-left">
                <label class="mx-1 text-xs text-gray-500 " for="">Imagen</label>
                <div x-data="{ photoName: null, photoPreview: null }" class="grid grid-cols-6 ">
                    <!-- Profile Photo File Input -->
                    <input type="file" class="hidden " wire:model.defer="photo" x-ref="photo"
                        x-on:change="
                                        photoName = $refs.photo.files[0].name;
                                        const reader = new FileReader();
                                        reader.onload = (e) => {
                                            photoPreview = e.target.result;
                                        };
                                        reader.readAsDataURL($refs.photo.files[0]);
                                " />


                    <x-jet-secondary-button class="h-8 col-span-4 mt-2 mr-2" type="button"
                        x-on:click.prevent="$refs.photo.click()">
                        {{ __('Cargar imagen') }}
                    </x-jet-secondary-button>

                    <!-- Current Profile Photo -->
                    <div class="col-span-2 mt-2" x-show="!photoPreview">
                        @if ($photo!==NULL)
                            <img src="{{ asset($this->photo) }}" class="object-cover w-10 h-10 rounded-full">
                        @else
                            <img src="{{ asset('images/icons8-cubiertos-100.png') }}"
                                class="object-cover w-10 h-10 rounded-full">
                        @endif



                    </div>

                    <!-- New Profile Photo Preview -->
                    <div class="col-span-2 mt-2" x-show="photoPreview">
                        <span class="block w-10 h-10 rounded-full"
                            x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' +
                            photoPreview + '\');'">
                        </span>
                    </div>







                    <x-jet-input-error for="photo" class="mt-2" />
                </div>

            </div>
            <div class="px-3 mb-5">
                <label class="mx-1 text-xs text-gray-500 " for="">Apartados</label>

                <div class="relative">
                    <select id="select_a" class="absolute" wire:model.defer='select_apartado'
                        wire:click="$emit('apartado')">
                        <option>seleccione</option>
                        @foreach ($apartados as $apartado)
                            <option value="{{ $apartado->descrip3 }}">{{ $apartado->descrip3 }}</option>
                        @endforeach
                        <option value="Otro...">Otro...</option>
                    </select>
                    <input wire:ignore wire:model='input_apartado' class="absolute " type="text"
                        placeholder="Otro..." id="input_a">

                </div>

                @error('select_apartado')
                    <span class="relative text-xs italic text-red-500 top-7">{{ $message }}</span>
                @enderror
                @error('input_apartado')
                    <span class="relative text-xs italic text-red-500 top-7">{{ $message }}</span>
                @enderror
            </div>
            <div class="px-3 mb-5">
                <label class="mx-1 text-xs text-gray-500 " for="">impresora</label>
                <select wire:model.defer='impresora'>
                    @foreach ($impresoras as $impresora)
                        <option value="{{ $impresora->id }}">{{ $impresora->name }}</option>
                    @endforeach
                </select>
                @error('impresora')
                    <span class="text-xs italic text-red-500">{{ $message }}</span>
                @enderror



            </div>
            <div class="px-3 text-left md:col-span-3">
                <label class="mx-1 text-xs text-gray-500 " for="">Descripcion</label>
                <textarea wire:model.defer="descrip"
                    placeholder="contenido alcohólico de 5,9% en volumen. De color dorado intenso y aroma afrutado, capaz de transformar los momentos cotidianos en instantes cruciales. Con un amargor moderado y aromático, coronada por una espuma de color blanco roto."
                    class="w-full border border-gray-200 focus:outline-none focus:shadow-md focus:bg-gray-100 focus:border-gray-600">
                </textarea>
                @error('descrip')
                    <span class="text-xs italic text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="px-3 text-left md:col-span-3">
                <label class="mx-1 text-xs text-gray-500 " for="">Maridaje</label>
                <textarea wire:model.defer="descrip2" placeholder=""
                    class="w-full border border-gray-200 focus:outline-none focus:shadow-md focus:bg-gray-100 focus:border-gray-600">
                </textarea>
                @error('descrip2')
                    <span class="text-xs italic text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="md:col-span-3">
                <div class="flex items-center justify-between pb-4 mx-5 mt-2 border-b mb-b">
                    @if (count($presentaciones) < 3)
                        <h2 class="text-xl text-gray-600">Presentaciones</h2>

                        <button wire:click="add" type="button"
                            class="p-1 text-white bg-blue-300 rounded-lg focus:outline-none hover:bg-blue-500">
                            {{ __('Add') }}
                        </button>
                    @endif
                </div>

                @foreach ($presentaciones as $index => $presentacion)
                    <div class="grid grid-cols-2 md:grid-cols-3 efecto_in">
                        <div class="px-3 text-left ">
                            <label class="mx-1 text-xs text-gray-500 " for="">presentacion</label>
                            <input type="test" step="0.01" autocomplete="true" value="0"
                                placeholder="1.00" wire:model.defer="presentaciones.{{ $index }}.name"
                                class=" focus:outline-none focus:shadow-md focus:bg-gray-100 focus:border-gray-600">
                            @error('presentaciones.' . $index . '.name')
                                <span class="text-xs italic text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- <div class="px-3 text-left">
                        <label class="mx-1 text-xs text-gray-500 " for="">precio de compra</label>
                        <input type="number" step="0.01" autocomplete="true" value="0" placeholder="1.00"  
                            wire:model.defer="presentaciones.{{ $index }}.costo" class=" focus:outline-none focus:shadow-md focus:bg-gray-100 focus:border-gray-600">
                        @error('presentaciones.' . $index . '.costo')
                            <span class="text-xs italic text-red-500">{{ $message }}</span>
                        @enderror
                    </div> --}}
                        <div class="px-3 text-left">
                            <label class="mx-1 text-xs text-gray-500 " for="">precio de venta</label>
                            <input type="number" step="0.01" autocomplete="true" placeholder="1.20"
                                wire:model.defer="presentaciones.{{ $index }}.precio_venta"
                                class=" focus:outline-none focus:shadow-md focus:bg-gray-100 focus:border-gray-600">
                            @error('presentaciones.' . $index . '.precio_venta')
                                <span class="text-xs italic text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        {{--                     <div class="px-3 text-left ">
                        <label class="mx-1 text-xs text-gray-500 " for="">peso(gramos(g))</label>
                        <input type="number" step="0.01" autocomplete="true" placeholder="100"  
                            wire:model.defer="presentaciones.{{ $index }}.peso" class=" focus:outline-none focus:shadow-md focus:bg-gray-100 focus:border-gray-600">
                        @error('presentaciones.' . $index . '.peso')
                            <span class="text-xs italic text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="px-3 text-left">
                        <label class="mx-1 text-xs text-gray-500 " for="">unidad de medida (ml,L,etc)</label>
                        <select placeholder="200" value="Ml"   wire:model.defer="presentaciones.{{ $index }}.unidad_medida"
                            class="focus:outline-none focus:shadow-md focus:bg-gray-100 focus:border-gray-600">
                
                            <option value="ml" selected>mililitro (ml)</option>
                            <option value="cl">centilitro (cl)</option>
                            <option value="dl">decilitro (dl)</option>
                
                        </select>
                        @error('presentaciones.' . $index . '.unidad_medida')
                            <span class="text-xs italic text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="px-3 text-left ">
                        <label class="mx-1 text-xs text-gray-500 " for="">volumen</label>
                        <input type="number" step="0.01" autocomplete="true" placeholder="1"  
                            wire:model.defer="presentaciones.{{ $index }}.volumen" class=" focus:outline-none focus:shadow-md focus:bg-gray-100 focus:border-gray-600">
                        @error('presentaciones.' . $index . '.volumen')
                            <span class="text-xs italic text-red-500">{{ $message }}</span>
                        @enderror
                    </div> --}}
                        <div class="px-3 text-left block-inline">
                            @if (count($presentaciones) > 1)
                                <button wire:click="remove_pre({{ $index }})" type="button"
                                    class="p-1 mt-6 text-white bg-red-300 rounded-lg focus:outline-none hover:bg-red-500">
                                    {{ __('Remove') }}
                                </button>
                            @endif



                        </div>


                    </div>
                @endforeach




            </div>
            <div class="px-3 text-center ">
                <div class="w-auto pl-3 text-center align-middle">
                    <div class="pt-5">
                        <button type="submit"
                            class="z-10 px-3 py-2 text-indigo-500 bg-indigo-100 rounded hover:bg-indigo-500 hover:shadow-lg hover:text-gray-100">
                            guardar producto</button>

                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
