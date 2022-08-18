<div class=" min-h-screen mx-auto p-10 w-full md:w-11/12 bg-cool-gray-50 shadow-lg my-5  ">
    {{-- formulario --}}
    @if ($updateMode)
        @include('livewire.negocio.update')
    @else
        @include('livewire.negocio.create')
    @endif
    {{-- tabla --}}


    <div class="shadow-sm overflow-hidden my-8">
        <h1 class=" inline-block text-2xl sm:text-3xl  text-gray-400 tracking-tight font-mono font-black ">Personal</h1>
        <table class="border-collapse table-auto  w-full text-xs md:text-sm ">
            <thead>

                <tr class="h-4 md:h-16 bg-gradient-to-b from-gray-50 to-gray-200">
                    <th class="  font-medium  p-2 md:p-4 pr-8 pt-0 pb-3 text-gray-400 text-left truncate">#</th>
                    <th class="  font-medium  p-2 md:p-4 pr-8 pt-0 pb-3 text-gray-400 text-left truncate">Name</th>
                    <th
                        class="  font-medium  p-2 md:p-4 pr-8 pt-0 pb-3 text-gray-400 text-left hidden md:table-cell truncate">
                        Email</th>
                    <th
                        class="  font-medium  p-2 md:p-4 pr-8 pt-0 pb-3 text-gray-400 text-left hidden md:table-cell truncate">
                        rol</th>
                    <th class="  font-medium  p-2 md:p-4 pr-8 pt-0 pb-3 text-gray-400 text-left hidden md:table-cell truncate"
                        width="150px">
                        Acciones</th>
                </tr>

            </thead>


            @forelse ($usuarios as $usuario)
                <tbody class="bg-white border-b-2 border-slate-100">
                    <tr>
                        <td class=" border-slate-100  p-2 md:p-4 pl-8 text-gray-400  truncate">{{ $usuario->id }}</td>
                        <td class=" border-slate-100  p-2 md:p-4 pl-8 text-gray-400 truncate">{{ $usuario->name }}</td>
                        <td class=" border-slate-100 hidden md:table-cell  p-2 md:p-4 pl-8 text-gray-400 truncate">
                            {{ $usuario->email }}</td>

                        <td class="hidden md:table-cell border-slate-100  p-2 md:p-4 pl-8 text-gray-400 truncate">
                            @if (isset($usuario->getRoleNames()[0]))
                                {{ $usuario->getRoleNames()[0] }}
                            @endif
                        </td>

                        <td class=" border-slate-100  hidden md:table-cell p-2 md:p-4 pl-8 text-gray-400 truncate">

                            <button wire:click="edit({{ $usuario->id }})"
                                class="px-2  bg-blue-200 text-blue-500 hover:bg-blue-500 hover:text-white rounded">Editar</button>
                                <button wire:click="$emit('delete',{{ $usuario->id }})"
                                class="px-2 borrarr bg-red-200 text-red-500 hover:bg-red-500 hover:text-white rounded">Borrar</button>


                        </td>
                    </tr>
                    <tr class="visible md:hidden ">
                        <td class=" border-slate-100  p-2 md:p-4 text-gray-400" colspan="2">Email:
                            {{ $usuario->email }}</td>
                    </tr>
                    <tr class="visible md:hidden ">
                        <td class=" border-slate-100  p-2 md:p-4 text-gray-400" colspan="2">Rol:
                            @if (isset($usuario->getRoleNames()[0]))
                                {{ $usuario->getRoleNames()[0] }}
                            @endif
                        </td>
                    </tr>
                    <tr class="visible md:hidden ">
                        <td class=" border-slate-100  p-2 md:p-4 text-gray-400" colspan="2">
                            <button wire:click="edit({{ $usuario->id }})"
                                class="px-2  bg-blue-200 text-blue-500 hover:bg-blue-500 hover:text-white rounded">Editar</button>
                            <button  wire:click="$emit('delete',{{ $usuario->id }})"
                                class="px-2 borrarr  bg-red-200 text-red-500 hover:bg-red-500 hover:text-white rounded">Borrar</button>
                        </td>
                    </tr>

                </tbody>
            @empty
                <div class="p-5 m-2 text-center text-4xl font-serif tracking-wide">
                    <h1> no hay registros</h1>
                </div>
            @endforelse



        </table>





    </div>
    @push('js')
    <script src="{{asset('js/personal/personal.js')}}"></script>
    @endpush
</div>

