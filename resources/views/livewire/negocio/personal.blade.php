<div class="hoja_base">
    {{-- formulario --}}
    @if ($updateMode)
        @include('livewire.negocio.update')
    @else
        @include('livewire.negocio.create')
    @endif
    {{-- tabla --}}
    <div class="shadow-sm overflow-hidden my-8">
        <h1 class="titulo_form ">Personal</h1>
        <table class="tabla md:text-base">
            <thead class="bg-gray-100">

                <tr class=" ">
                    <th class=" truncate">#</th>
                    <th class=" truncate">Name</th>
                    <th class=" hidden md:table-cell truncate">
                        Email</th>
                    <th class=" hidden md:table-cell truncate">
                        rol</th>
                    <th class=" hidden md:table-cell truncate" width="150px">
                        Acciones</th>
                </tr>

            </thead>


            @forelse ($usuarios as $usuario)
                <tbody class="bg-white border-b-2 ">
                    <tr>
                        <td class=" ">{{ $usuario->id }}</td>
                        <td class=" ">{{ $usuario->name }}</td>
                        <td class=" hidden md:table-cell  ">
                            {{ $usuario->email }}</td>

                        <td class="hidden md:table-cell ">
                            @if (isset($usuario->getRoleNames()[0]))
                                {{ $usuario->getRoleNames()[0] }}
                            @endif
                        </td>

                        <td class=" hidden md:table-cell">

                            <button wire:click="edit({{ $usuario->id }})"
                                class="ml-2 px-2 py-1  bg-blue-200 text-blue-500 hover:bg-blue-500 hover:text-white rounded"><i class="bi bi-pencil-fill"></i></button>
                            <button wire:click="$emit('delete',{{ $usuario->id }})"
                                class="ml-2 px-2 py-1  borrarr bg-red-200 text-red-500 hover:bg-red-500 hover:text-white rounded"><i class="bi bi-trash"></i></button>


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
                            <button wire:click="$emit('delete',{{ $usuario->id }})"
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

</div>
