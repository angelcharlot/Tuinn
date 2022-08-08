<div class="h-screen  m-10 p-5 rounded-sm border-gray-300 shadow-2xl bg-cool-gray-50">

        <h1 class="inline-block mb-5 text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight ">gestion de usuario</h1>

    {{-- formulario --}}
    @if ($updateMode)
        @include('livewire.negocio.update')
    @else
        @include('livewire.negocio.create')
    @endif
    {{-- tabla --}}

    <h1 class="inline-block text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight ">Personal</h1>
    <table class="border-collapse table-auto  w-full text-xs md:text-sm ">
        <thead>

            <tr class="h-4 md:h-16 bg-gradient-to-b from-gray-50 to-gray-200">
                <th class="  font-medium  p-2 md:p-4 pr-8 pt-0 pb-3 text-slate-400 text-left truncate">#</th>
                <th class="  font-medium  p-2 md:p-4 pr-8 pt-0 pb-3 text-slate-400 text-left truncate">Name</th>
                <th class="  font-medium  p-2 md:p-4 pr-8 pt-0 pb-3 text-slate-400 text-left hidden md:table-cell truncate">Email</th>
                <th class="  font-medium  p-2 md:p-4 pr-8 pt-0 pb-3 text-slate-400 text-left hidden md:table-cell truncate">rol</th>
                <th class="  font-medium  p-2 md:p-4 pr-8 pt-0 pb-3 text-slate-400 text-left hidden md:table-cell truncate" width="150px">
                    Acciones</th>
            </tr>

        </thead>


        @forelse ($usuarios as $usuario)
            <tbody class="bg-white border-b-2 border-slate-100">
                <tr>
                    <td class=" border-slate-100  p-2 md:p-4 pl-8 text-slate-500 truncate">{{ $usuario->id }}</td>
                    <td class=" border-slate-100  p-2 md:p-4 pl-8 text-slate-500 truncate">{{ $usuario->name }}</td>
                    <td class=" border-slate-100 hidden md:table-cell  p-2 md:p-4 pl-8 text-slate-500 truncate">{{ $usuario->email }}</td>

                    <td class="hidden md:table-cell border-slate-100  p-2 md:p-4 pl-8 text-slate-500 truncate">
                        @if (isset($usuario->getRoleNames()[0]))
                            {{ $usuario->getRoleNames()[0] }}
                        @endif
                    </td>

                    <td class=" border-slate-100  hidden md:table-cell p-2 md:p-4 pl-8 text-slate-500 truncate">

                        <button wire:click="edit({{ $usuario->id }})"
                            class="px-2  bg-blue-200 text-blue-500 hover:bg-blue-500 hover:text-white rounded">Editar</button>
                        <button wire:click="destroy({{ $usuario->id }})"
                            class="px-2  bg-red-200 text-red-500 hover:bg-red-500 hover:text-white rounded">Borrar</button>


                    </td>
                </tr>
                <tr class="visible md:hidden ">
                    <td class=" border-slate-100  p-2 md:p-4 text-slate-500" colspan="2">Email: {{ $usuario->email }}</td>
                </tr>
                <tr class="visible md:hidden ">
                    <td class=" border-slate-100  p-2 md:p-4 text-slate-500" colspan="2">Rol:
                        @if (isset($usuario->getRoleNames()[0]))
                        {{ $usuario->getRoleNames()[0] }}
                    @endif
                    </td>
                </tr>
                <tr class="visible md:hidden ">
                    <td class=" border-slate-100  p-2 md:p-4 text-slate-500" colspan="2">
                        <button wire:click="edit({{ $usuario->id }})"
                            class="px-2  bg-blue-200 text-blue-500 hover:bg-blue-500 hover:text-white rounded">Editar</button>
                        <button wire:click="destroy({{ $usuario->id }})"
                            class="px-2  bg-red-200 text-red-500 hover:bg-red-500 hover:text-white rounded">Borrar</button>
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
