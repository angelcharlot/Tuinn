@if (count($categorias->cat_hijos_todos) > 0 )
    <optgroup label="{{$categorias->name}}">
        @each('livewire.productos.partial',$categorias->cat_hijos_todos, 'categorias')
    </optgroup>
@else
<option value="{{$categorias->id}}">
{{$categorias->name}}
</option>

@endif




