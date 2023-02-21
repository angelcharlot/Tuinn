@extends('layouts/Coffeemaker')
@section('css')
<link rel="stylesheet" href="{{ asset('css/principal.css') }}">
@endsection




@section('body')
<x-logo-header />
<main class="bg-gray-100 py-8">
    <div class="container mx-auto px-4">
      
        <div class="flex flex-wrap -mx-4">

              
            <div class="flex flex-wrap -mx-4">
                <!-- Sección 1 -->
                <div class="w-full md:w-1/3 px-4 mb-8">
                    <div class="card shadow-lg mx-auto text-center">
                        <div class="flex justify-center items-center h-20 w-20  mx-auto rounded-full bg-gray-300 shadow">
                            <div class="flex justify-center items-center">
                                <i class="bi bi-megaphone  text-blue-500 text-3xl"></i>
                            </div>
                        </div>
                        <div class="px-6 py-4">
                            <h2 class="text-xl font-bold text-gray-800 mb-2">Aumenta tu clientela</h2>
                            <p class="text-gray-700 leading-relaxed">Permite que tus clientes reserven una mesa en cualquier momento del día a través de nuestra plataforma en línea. Además, integra nuestro sistema de reservas en tu sitio web para ofrecer una experiencia de usuario aún más completa.</p>
                        </div>
                    </div>
                </div>
                
              
                <!-- Sección 2 -->
                <div class="w-full md:w-1/3 px-4 mb-8">
                    <div class="card shadow-lg mx-auto text-center">
                      <div class="flex justify-center items-center h-20 w-20 mx-auto rounded-full bg-gray-300 shadow">
                        <div class="flex justify-center items-center">
                            <i class="bi bi-hand-thumbs-up text-blue-500 text-3xl"></i>


                        </div>
                      </div>
                      <div class="px-6 py-4">
                        <h2 class="text-xl font-bold text-gray-800 mb-2">Mejora la atención a tus clientes</h2>
                        <p class="text-gray-700 leading-relaxed">Nuestro sistema de comanderos digitales permite que tus meseros tomen las órdenes directamente desde las mesas y las envíen automáticamente a la cocina y la barra. Esto reduce el tiempo de espera y mejora la satisfacción de tus clientes. ¡Ofrece una atención rápida y eficiente que tus clientes nunca olvidarán!</p>
                      </div>
                    </div>
                </div>
                  
              
                <!-- Sección 3 -->
                <div class="w-full md:w-1/3 px-4 mb-8">
                    <div class="card shadow-lg mx-auto text-center">
                        <div class="flex justify-center items-center h-20 w-20 mx-auto rounded-full bg-gray-300 shadow">
                            <div class="flex justify-center items-center">
                                
                                <i class="bi bi-list-task  text-blue-500 text-3xl"></i>

                            </div>
                        </div>
                        <div class="px-6 py-4">
                            <h2 class="text-xl font-bold text-gray-800 mb-2">Ofrece una experiencia de menú digital</h2>
                            <p class="text-gray-700 leading-relaxed">Con nuestro sistema de carta QR, tus clientes pueden acceder a una experiencia de menú completamente digital. Al escanear el código QR en su teléfono, podrán visualizar el menú completo de tu restaurante, con fotos y descripciones de cada platillo y bebida. Además, puedes actualizar fácilmente el menú en línea para reflejar cambios en la oferta de tu restaurante.</p>
                        </div>
                    </div>
                </div>
                
                
              
              
       
        </div>
    </div>
</main>

  

@endsection







