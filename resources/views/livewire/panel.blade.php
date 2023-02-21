<div class="w-11/12 pb-10 mx-auto">
    <div class="grid grid-cols-1 gap-4 mt-10">
      <div class="p-5 border border-green-900 rounded-lg shadow-sm">
        <div class="h-10 flex items-center justify-center text-white bg-green-500 rounded-t-md">PRODUCTOS</div>
        <div class="flex items-center mt-5">
          <span class="text-gray-600 mr-2">Cantidad de productos:</span>
          <span class="text-blue-900 bg-blue-300 rounded-full px-2 py-1">{{ $nro_productos }}</span>
        </div>
        @foreach ($categorias as $categoria)
          <div class="flex items-center mt-2">
            <span class="text-gray-600 mr-2">{{ $categoria->name }}:</span>
            <span class="text-blue-900 bg-blue-300 rounded-full px-2 py-1">{{ $categoria->productos->count() }}</span>
          </div>
        @endforeach
        <div class="flex items-center mt-2">
          <span class="text-gray-600 mr-2">Productos fuera de la carta:</span>
          <span class="text-blue-900 bg-blue-300 rounded-full px-2 py-1">{{ $productos_false }}</span>
        </div>
      </div>
      <div class="p-5 border border-blue-500 rounded-lg shadow-sm h-52">Cuadros de información</div>
      <div class="p-5 border border-red-500 rounded-lg shadow-sm h-52">Cuadros de información</div>
    </div>
  </div>
  