<div>




    <div class=" min-h-screen mx-auto p-10 w-full md:w-11/12 bg-cool-gray-50 shadow-lg my-5 ">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-2 text-gray-600">
            @forelse ($categorias as $categoria)

            <div wire:click="buscar({{$categoria->id}})" class="border-2 border-gray-200 min-h-30 rounded-lg shadow-sm bg-white hover:bg-gray-100  divide-y divide-solid ">
                <div class=" header   grid grid-cols-6 p-3 text-base bg-gray-50">
                    <div class=" text-left col-span-1"><i class="bi bi-bookmarks"></i></div>
                    <div class=" text-center col-span-4 font-semibold">{{$categoria->name}}</div>
                    <div class=" text-right cols-span-1"><i class="bi bi-x-circle"></i></div>
                </div>
                <div class="p-3 text-xs ">
                    {{$categoria->descrip}}
                </div>
                <div></div>

            </div>

            @empty
            <div>no hay registros</div>
            @endforelse
        </div>

    </div>



</div>
