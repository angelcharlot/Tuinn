
<div class="m-10 p-5 rounded-sm border-gray-300 shadow-2xl bg-gray-100">
<div class="w-full h-16 bg-blue-200 grid justify-items-center  my-5 shadow-lg rounded text-gray-500 text-2xl pt-3"><span class="">gestion de usuario</span> </div>
{{-- formulario --}}
  @if($updateMode)
        @include('livewire.negocio.update')
    @else
        @include('livewire.negocio.create')
    @endif
{{-- tabla --}}


<table class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">

  <thead class="text-white">
    @for ($i = 0; $i < count($usuarios) ; $i++)

    <tr class="bg-teal-400 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
        <th class="p-3 text-left">#</th>
        <th class="p-3 text-left">Name</th>
        <th class="p-3 text-left">Email</th>
        <th class="p-3 text-left">rol</th>
        <th class="p-3 text-left" width="150px">Acciones</th>
    </tr>

    @endfor
</thead> 

            <tbody class="flex-1 sm:flex-none">
                 @forelse ($usuarios as $usuario) 
                <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">
                    <td class="border-grey-light border hover:bg-gray-100 p-3">{{ $usuario->id }}</td>
                    <td class="border-grey-light border hover:bg-gray-100 p-3 truncate">{{ $usuario->name }}</td>
                     <td class="border-grey-light border hover:bg-gray-100 p-3 truncate">{{ $usuario->email }}</td>
                    
                     <td class="border-grey-light border hover:bg-gray-100 p-3 truncate">
                        @if(isset($usuario->getRoleNames()[0]))
                        {{ $usuario->getRoleNames()[0] }}
                        @endif
                    </td>

                    <td class="border-grey-light border hover:bg-gray-100 p-3 text-red-400 hover:text-red-600 hover:font-medium cursor-pointer">

                        <button wire:click="edit({{ $usuario->id }})" class="px-2  bg-blue-200 text-blue-500 hover:bg-blue-500 hover:text-white rounded">Editar</button>
                        <button wire:click="destroy({{ $usuario->id }})" class="px-2  bg-red-200 text-red-500 hover:bg-red-500 hover:text-white rounded">Borrar</button>


                    </td>
                </tr>
                @empty
                <div class="p-5 m-2 text-center text-4xl font-serif tracking-wide">
                    <h1> no hay registros</h1>
                </div>
               
                @endforelse 
            </tbody>

</table>






<style>
  html,
  body {
    height: 100%;
  }

  @media (min-width: 640px) {
    table {
      display: inline-table !important;
    }

    thead tr:not(:first-child) {
      display: none;
    }
  }

  td:not(:last-child) {
    border-bottom: 0;
  }

  th:not(:last-child) {
    border-bottom: 2px solid rgba(0, 0, 0, .1);
  }
</style>
        </tbody>

</table>





</div>
