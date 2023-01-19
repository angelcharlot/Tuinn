<div class=" container mx-auto pb-10">
    
    <div class=" grid-cols-3 grid gap-2 mt-10" >
        <div class="p-5 h-52 border border-green-500 rounded-lg shadow-sm  ">
            <div>nro de productos:{{$nro_productos}}</div>
             
             @foreach ($categorias as $categoria)
                 <div>{{$categoria->name}}: {{$categoria->productos->count()}}</div>
             @endforeach
             productos fuera de la carta: {{$productos_false}}
        </div>
        <div class="p-5 h-52 border border-blue-500 rounded-lg shadow-sm  "> cuadros de info </div>
        <div class="p-5 h-52 border border-red-500 rounded-lg shadow-sm  "> cuadros de info </div>
    </div>


</div>
