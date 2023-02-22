@extends('layouts/Coffeemaker')
@section('css')
<link rel="stylesheet" href="{{ asset('css/principal.css') }}">
@endsection
@section('body')
<x-logo-header />
<main class="bg-gray-100 py-8 mb-10">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap -mx-3">
            <div class="flex flex-wrap -mx-3">
                <!-- Sección 1 -->
                <div class="w-full md:w-1/3 px-4 pb-8">
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
                <div class="w-full md:w-1/3 px-4 pb-8">
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
                <div class="w-full md:w-1/3 px-4 pb-8 ">
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
<section class="bg-gray-100 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl font-extrabold text-gray-900 text-center">Quiénes somos</h2>
      <p class="mt-4 text-lg text-gray-500 text-center">Conoce a nuestro equipo de desarrolladores y colaboradores</p>
      <div class="mt-10 grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-3">
        <div class="relative m-8">
          <div class="overflow-hidden rounded-lg shadow-md">
            <img class="w-full transform transition-all duration-500 hover:scale-110" src="https://via.placeholder.com/500x350" alt="">
          </div>
          <div class="px-6 py-4 bg-white text-xs">
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Consultor</h3>
            <p class="text-gray-700 ">
              Paco Medina es una figura pública muy reconocida en la provincia de Cádiz por su exitosa trayectoria en la industria de la hostelería. Paco es el dueño de la famosa  "Bodeguita Mi Pueblo" en Olvera, Cádiz, y recientemente ganó el Concurso Cierra de Cádiz.
            </p >
            <p class="text-gray-700 ">
              Además de ser un empresario exitoso, Paco Medina también es un experto en la industria de la hostelería y ha colaborado como consultor en nuestro sistema de comandas. Gracias a su vasta experiencia y conocimientos en el área, ha sido capaz de brindar información valiosa y estratégica para mejorar nuestro servicio de comandas y llevarlo al siguiente nivel.
            </p>
            <p class="text-gray-700 ">
              Por estas razones y muchas más, Paco Medina es un referente en el mundo de la hostelería y la gastronomía en la provincia de Cádiz y en toda España. Su éxito es un testimonio de su arduo trabajo, su compromiso con la calidad y su capacidad para mantenerse a la vanguardia de las últimas tendencias.
            </p>
          </div>
        </div>
        <div class="relative m-8">
          <div class="overflow-hidden rounded-lg shadow-md">
            <img class="w-full transform transition-all duration-500 hover:scale-110" src="https://via.placeholder.com/500x350" alt="">
          </div>
          <div class="px-6 py-4 bg-white">
            <h3 class="text-xl font-semibold text-gray-900 mb-2">CEO (Director Ejecutivo)</h3>
            <p class="text-gray-700 text-xs">
                Ángel Charlot es un ingeniero en informática de nacionalidad venezolana con más de 8 años de experiencia en diferentes cargos. Su amplio conocimiento y experiencia en el campo de la informática le han permitido desarrollar una serie de sistemas innovadores y funcionales en diferentes áreas.

                Su experiencia abarca el desarrollo de software en múltiples lenguajes de programación, la gestión de proyectos, el análisis de datos y la creación de soluciones tecnológicas a medida. Su enfoque se centra en la implementación de sistemas de alta calidad, eficientes y escalables que satisfagan las necesidades de los usuarios y clientes.
                
                Ángel Charlot es un profesional altamente capacitado y con un sólido compromiso con la excelencia y la innovación en el desarrollo de sistemas informáticos. Gracias a su capacidad para trabajar en equipo, su dedicación y su habilidad para resolver problemas, ha logrado sobresalir en el campo de la informática y ha sido reconocido por su valiosa contribución en la creación de sistemas de última generación.
            </p>
          </div>
        </div>
        <div class="relative m-8">
          <div class="overflow-hidden rounded-lg shadow-md">
            <img class="w-full transform transition-all duration-500 hover:scale-110" src="https://via.placeholder.com/500x350" alt="">
          </div>
          <div class="px-6 py-4 bg-white">
            <h3 class="text-xl font-semibold text-gray-900 mb-2">CTO (Director de Tecnología)</h3>
            <p class="text-gray-700 text-xs">
                Adel Lemuz es un CTO altamente experimentado y un programador multilingüe que ha demostrado habilidades y conocimientos sobresalientes en el campo de la tecnología. Con más de una década de experiencia en la industria, Adel ha trabajado en una variedad de proyectos y ha demostrado ser un líder técnico y estratégico excepcional.

                Como CTO, Adel tiene una visión clara de la tecnología y sabe cómo aprovecharla para impulsar el crecimiento y la innovación. Es un experto en la arquitectura y el diseño de sistemas, y tiene una comprensión profunda de los desafíos técnicos que enfrentan las empresas modernas. Adel también es un comunicador efectivo y trabaja en estrecha colaboración con los equipos de desarrollo y de negocios para asegurarse de que los proyectos se completen a tiempo y dentro del presupuesto.
                
                
                En general, Adel es un CTO altamente calificado y un programador excepcionalmente talentoso con una amplia experiencia en la industria de la tecnología. Su pasión por la tecnología y su capacidad para liderar equipos y proyectos lo convierten en una parte valiosa de cualquier organización que busque innovar y liderar en el mercado.
            </p>
          </div>
        </div>
      </div>
    </div></section>  
  
  
  
  

@endsection







