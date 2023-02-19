<div>
    <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
        <div class="max-w-xl mb-10 md:mx-auto sm:text-center lg:max-w-2xl md:mb-12">
            <div>
                <p
                    class="inline-block px-3 py-px mb-4 text-xs font-semibold tracking-wider text-teal-900 uppercase rounded-full bg-teal-accent-400">
                    Configuracion
                </p>
            </div>
            <h2
                class="max-w-lg mb-6 font-sans text-3xl font-bold leading-none tracking-tight text-gray-900 sm:text-4xl md:mx-auto">
                <span class="relative inline-block">

                    <span class="relative">La</span>
                </span>
                configuracion de area de trabajo.
            </h2>
            <p class="text-base text-gray-700 md:text-lg">
                Es muy importante tener configurada las areas en las que separas tus mesas, en esta configuracion podras
                agregar las areas en las que divives
                tu negocio asi como las mesas que tienes en cada area.
            </p>
        </div>
        <div class="text-center">
            <a href="#" wire:click="$set('bn_modal_area','1')"
                class="inline-flex items-center justify-center w-full h-12 px-6 font-medium tracking-wide text-blue-500 transition duration-200 rounded shadow-md md:w-auto bg-deep-purple-accent-400 hover:bg-deep-purple-accent-700 focus:shadow-outline focus:outline-none">
                Agregar Area
            </a>

        </div>
        <div class="grid gap-5 mt-10 mb-8 md:grid-cols-2 lg:grid-cols-3">


            @forelse ($areas as $area)
                <div wire:click="seleccionar({{ $area->id }})"
                    class="p-5 duration-300 transform bg-white border rounded shadow-sm hover:-translate-y-2">
                    <div class="flex items-center justify-center w-12 h-12 mb-4 rounded-full bg-indigo-50">
                        <img src="{{ asset('storage/banner/mesas.png') }}" alt="">
                    </div>
                    <h6 class="mb-2 font-semibold leading-5">{{ $area->name }}</h6>
                    <p class="text-sm text-gray-900">
                        tienes un total de {{ count($area->mesas) }} mesas en esta area
                    </p>
                </div>
            @empty
            @endforelse


        </div>
        <x-jet-section-border />
        @if ($bn_mesa == 1)
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <div class="w-full">
                    <div class="float-right ">
                        <button type="button" wire:click="$set('bn_modal_mesas','1')"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">agregar
                            mesa</button>
                    </div>

                </div>
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">



                    <caption
                        class="p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                        mesas listada en el area seleccionada
                        <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Browse a list of Flowbite
                            listado de mesas, se mostraran datos relevantes de las mesas una vez aya suficientes datos
                            estadisticos
                        </p>

                    </caption>
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Codigo de la mesa
                            </th>
                            <th scope="col" class="px-6 py-3">
                                name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                numero
                            </th>
                            <th scope="col" class="px-6 py-3">
                                area
                            </th>

                        </tr>
                    </thead>
                    @foreach ($area_selec->mesas as $mesa)
                        <tbody>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $mesa->id }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $mesa->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $mesa->nro }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $mesa->area->name }}
                                </td>
                            </tr>

                        </tbody>
                    @endforeach
                </table>
            </div>
        @endif



    </div>


    <!-- Modal area -->
    <!-- Main modal -->
    @if ($bn_modal_area == 1)
        <div class="fixed top-0 left-0 z-30 w-full h-full bg-gray-500 opacity-25"
            wire:click="$set('bn_modal_area','0')"></div>

        <div class="fixed z-40 w-8/12 p-4 mx-auto h-3/12 pt-52 md:inset-0">

            <div class="w-full h-full max-w-md mx-auto relativez-50 md:h-auto">
                <!-- Modal content -->
                <div class="relative text-white bg-blue-600 rounded-lg shadow dark:bg-gray-700">
                    <button type="button" wire:click="$set('bn_modal_area','0')"
                        class="absolute top-3 right-2.5 text-gray-50 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                        data-modal-hide="authentication-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="px-6 py-6 lg:px-8">
                        <h3 class="mb-4 text-xl font-medium text-gray-50 dark:text-white">Nombre del area a registrar.
                        </h3>
                        <form class="space-y-6" action="#">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-50 dark:text-white">nombre
                                </label>
                                <input type="text" wire:model="name_area"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="Salon" required>
                            </div>
                            <button type="button" wire:click="agregar_area"
                                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal mesas -->
    <!-- Main modal -->
    @if ($bn_modal_mesas == 1)
        <div class="fixed top-0 left-0 z-30 w-full h-full bg-gray-500 opacity-25"
            wire:click="$set('bn_modal_mesas','0')"></div>

        <div class="fixed z-40 w-8/12 p-4 mx-auto h-3/12 pt-52 md:inset-0">

            <div class="w-full h-full max-w-md mx-auto relativez-50 md:h-auto">
                <!-- Modal content -->
                <div class="relative text-white bg-blue-600 rounded-lg shadow dark:bg-gray-700">
                    <button type="button" wire:click="$set('bn_modal_mesas','0')"
                        class="absolute top-3 right-2.5 text-gray-50 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                        data-modal-hide="authentication-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="px-6 py-6 lg:px-8">
                        <h3 class="mb-4 text-xl font-medium text-gray-50 dark:text-white">Seleccione el numero de mesa a
                            añadir.
                        </h3>
                        <form class="space-y-6" action="#">
                            <div>
                                
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">numero</label>
                                <select wire:model="name_mesa"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="">Seleccione</option>
                                    @for ($i = 1; $i < 300; $i++)
                                        @php
                                            $bn=sizeof($area_selec->mesas->where("nro","=",$i));
                                        @endphp
                                        @if($bn==0)
                                        <option value="{{$i}}">{{$i}}</option> 
                                        
                                        @endif
                                    @endfor
                                </select>
                            </div>
                            <button type="button" wire:click="agregar_mesa({{$area_selec->id}})"
                                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif



</div>
