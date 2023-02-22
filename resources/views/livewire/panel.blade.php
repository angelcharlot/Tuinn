<div class="w-11/12 mt-10 pb-10 mx-auto">
  <div class="flex flex-col bg-white p-4 rounded-lg shadow-lg">
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-lg font-medium text-gray-800">Estadísticas de productos</h2>

    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
      <div class="flex items-center p-4 bg-blue-500 rounded-lg text-white">
        <div class="flex-shrink-0">
          <i class="bi bi-basket2-fill text-4xl"></i>
        </div>
        <div class="ml-4">
          <p class="text-lg font-medium">Total de productos</p>
          <p class="text-3xl font-bold">{{ $productos->count() }}</p>
        </div>
      </div>
      <div class="flex items-center p-4 bg-green-500 rounded-lg text-white">
        <div class="flex-shrink-0">
          <i class="bi bi-check2-square text-4xl"></i>
        </div>
        <div class="ml-4">
          <p class="text-lg font-medium">Productos activos</p>
          <p class="text-3xl font-bold">{{ count($productos->where('activo', 1)) }}</p>
        </div>
      </div>
      <div class="flex items-center p-4 bg-yellow-500 rounded-lg text-white">
        <div class="flex-shrink-0">
          <i class="bi bi-clock text-4xl"></i>
        </div>
        <div class="ml-4">
          <p class="text-lg font-medium">Productos inactivos</p>
          <p class="text-3xl font-bold">{{ count($productos->where('activo', 0)) }}</p>
        </div>
      </div>
      <div class="flex items-center p-4 bg-red-500 rounded-lg text-white">
        <div class="flex-shrink-0">
          <i class="bi bi-heart-fill text-4xl"></i>
        </div>
        <div class="ml-4">
          <p class="text-lg font-medium">Productos con likes positivos</p>
          <p class="text-3xl font-bold">{{$mro_megusta}}</p>
        </div>
      </div>
      <div class="flex items-center p-4 bg-blue-500 rounded-lg text-white">
        <div class="flex-shrink-0">
          <i class="bi bi-heart text-4xl"></i>
        </div>
        <div class="ml-4">
          <p class="text-lg font-medium">Productos con no me gusta</p>
          <p class="text-3xl font-bold">{{$mro_nomegusta}}</p>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
  