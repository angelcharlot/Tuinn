<div class="w-11/12 pb-10 mx-auto ">
    
    <div class="grid grid-cols-1 gap-2 mt-10 " >
        <div class="p-5 border border-green-900 rounded-lg shadow-sm h-68 ">
            <div class="h-10 pt-1 mb-5 text-center text-white bg-green-500 rounded-md">PRODUCTOS</div>
            <div class="flex" >Cantidad de productos: <h1 class="ml-5 text-center text-white bg-blue-900 rounded-full w-7 h-7">{{$nro_productos}}</h1></div>
             
             @foreach ($categorias as $categoria)
                 <div class="flex" >{{$categoria->name}}: <h1 class="ml-5 text-center text-white bg-blue-900 rounded-full w-7 h-7">{{$categoria->productos->count()}}</h1></div>
             @endforeach
             <div class="flex">   productos fuera de la carta: <h1 class="ml-5 text-center text-white bg-blue-900 rounded-full w-7 h-7">{{$productos_false}}</h1></div>
        </div>
        <div class="p-5 border border-blue-500 rounded-lg shadow-sm h-52 "> cuadros de info </div>
        <div class="p-5 border border-red-500 rounded-lg shadow-sm h-52 "> cuadros de info </div>
    </div>


</div>
