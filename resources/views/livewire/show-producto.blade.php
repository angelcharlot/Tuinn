<div>
    {{-- carta --}}
    <div wire:click="$set('open',true)"
        class=" grid-cols-2 grid border border-gray-200 m-1 rounded-md shadow-xs p-1 hover:border-indigo-300 hover:shadow-2xl ">
        <div><img class="w-full rounded-md" src="{{ asset($producto->img) }}" alt="Sunset in the mountains">
        </div>
        <div>
            <table class="w-full ">
                <tbody>
                    <tr>
                        <td class=" text-center font-extrabold  ">
                            {{ $producto->name }}
                        </td>
                    </tr>

                    <tr>
                        <td class="text-center text-green-900 text-2xl font-medium ">
                            &euro; {{ $producto->precio_venta }}
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
        <div class="col-span-2 text-ellipsis overflow-hidden ... h-10  ">
            {{ $producto->descrip }}
        </div>
        <div class="col-span-2  flex items-center ">

        </div>
        <div class="col-span-2">
            @foreach ($producto->categorias as $categoria)
                <span style="font-size: 8px;line-height: 11px;letter-spacing: 0.027em;font-weight: 875;"
                    class="inline-block bg-gray-200 rounded-full px-1 py-1  font-semibold text-gray-700 mr-2 mb-2">#{{ $categoria->name }}</span>
            @endforeach
        </div>
    </div>

    {{-- modal --}}
    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            <div class="grid grid-cols-6">
                <div class=" col-span-5 "
                    style="font-size: 22px;line-height: 25px;letter-spacing: 0.042em;font-weight: 697;">
                    {{ $producto->name }}
                </div>
                <div wire:click="$set('open',false)"
                    class=" col-span-1 text-right text-red-800 font-bold cursor-pointer ">
                    <i class="bi bi-x-lg"></i>
                </div>
            </div>

        </x-slot>
        <x-slot name="content">
            <div class="justify-center h-48 w-5/6 mx-auto border border-gray-200">
                <img class=" h-full object-scale-down mx-auto " src="{{ asset($producto->img) }}" alt="Sunset">
            </div>
            <div class="  w-5/6 mx-auto mt-5"
                style="letter-spacing: -0.053em;font-weight: 860;line-height: 34px;font-size: 34px;">
                &euro; {{ $producto->precio_venta }}
            </div>
            <div class="  w-5/6 mx-auto text-lg font-bold">descripcion:</div>

           {{--  <div class="  w-5/6 mx-auto text-base text-gray-400 text-justify">{{ $producto->descrip }} --}}
            <div class="  w-5/6 mx-auto text-base text-gray-400 text-justify">{{ $producto->descrip }}


            </div>


        </x-slot>
        <x-slot name="footer">
            <div class="">
                @foreach ($producto->categorias as $categoria)
                    <span
                        class="inline-block bg-gray-200 rounded-full px-1 py-1  font-semibold text-gray-700 mr-2 mb-2">#{{ $categoria->name }}</span>
                @endforeach
            </div>
        </x-slot>

    </x-jet-dialog-modal>

</div>
