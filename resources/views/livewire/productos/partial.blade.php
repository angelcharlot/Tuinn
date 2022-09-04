
@for ($i = 0; $i < count($categorias->cat_hijos_todos); $i++)
    @php
        $categorias->cat_hijos_todos[$i]->profundidad = $categorias->profundidad + 1;
        $categorias->cat_hijos_todos[$i]->ids .= $categorias->ids."-".$categorias->cat_hijos_todos[$i]->id;
    @endphp
@endfor
@if (count($categorias->cat_hijos_todos) > 0)

<span role="menuitem" tabindex="-1"
    class=" pl-{{$categorias->profundidad*4}} bg-gray-100 h-8 pt-1 flex justify-between w-full px-4  text-sm leading-5 text-left text-black font-extrabold  cursor-not-allowed "
    >
    {{$categorias->name}}--{{$categorias->ids}}
</span>
@each('livewire.productos.partial',$categorias->cat_hijos_todos, 'categorias')
@else
<a wire:click="changeEvent({{$categorias->id}},'{{$categorias->name}}','{{$categorias->ids}}')" tabindex="0" aria-haspopup="false" aria-expanded="false" aria-controls="headlessui-menu-items-117"
class=" pl-{{$categorias->profundidad*4}} hover:bg-blue-500 text-gray-700 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left" role="menuitem">
{{$categorias->name}}{{$categorias->ids}}
</a>


@endif

