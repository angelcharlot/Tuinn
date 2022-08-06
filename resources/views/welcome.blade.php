<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <title>Laravel</title>
@livewireStyles
    

    
    </head>
    
    <body class="antialiased">

    <nav class="bg-white shadow-lg">
            <div class="max-w-6xl mx-auto px-4">
                <div class="flex justify-between">
                    <div class="flex space-x-7">
                        <div class="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300">
                            <!-- Website Logo -->
                            <p>CoffeeMaker</p>
                        </div>
                
                    </div>
                    <!-- Secondary Navbar items -->
                    @if (Route::has('login'))
                    <div class="flex items-center space-x-3 ">
                         @auth
                        
                        @else
                        <a href="{{ route('login') }}" class="py-2 px-2 font-medium text-gray-500 rounded hover:bg-green-500 hover:text-white transition duration-300">login</a>
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="py-2 px-2 font-medium text-white bg-green-500 rounded hover:bg-green-400 transition duration-300">Registro</a>
                         @endif
                         @endauth
                    </div>
                    @endif
       
                </div>
            </div>

        </nav>
    

        <div class="container mx-auto">


          <div class=" bg-gray-100 text-center min-h-screen mt-10 pt-5" >
              
              <div class="text-2xl">bienvenidos a Coffeemaker¡</div>
              <div class="text-justify p-10">
              <cite class="text-justify">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</cite>
            </div>
          

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3 p-5">

                <div class="pt-3 bg-blue-50 shadow-md">
                    <div class="grid justify-items-center h-60">
                        <img class="h-auto w-3/4 rounded-t-lg shadow-md" src="{{ asset("images/1.jpg") }}" alt=""/>
                    </div>
                    
                    <div class="w-full text-justify p-2">
                        Narrative beef noodles 3D-printed drone construct uplink military-grade gang courier papier-mache systemic assassin woman industrial grade towards pre-physical. Nodality Chiba Shibuya woman monofilament into receding gang faded modem youtube garage neon drugs pre-meta.
                    </div>

                    
                </div>
                <div class="pt-3 bg-blue-50 shadow-md">
                    <div class="grid justify-items-center h-60">
                    <img class="h-auto w-3/4 rounded-t-lg shadow-md" src="{{ asset("images/2.jpg") }}" alt=""/>
                    </div>
                    <div class="w-full text-justify p-2">
                        Tank-traps sprawl pen market film geodesic disposable. Faded stimulate advert denim convenience store bomb rain carbon Tokyo assassin. Vehicle systema spook face forwards voodoo god euro-pop fetishism cardboard nodality post-grenade. 
                    </div>

                    
                </div>
                <div class=" pt-3 bg-blue-50 shadow-md">
                    <div class="grid justify-items-center h-60">
                    <img class="h-auto w-3/4 rounded-t-lg shadow-md" src="{{ asset("images/3.jpg") }}" alt=""/>
                    </div>
                    <div class="w-full text-justify p-2">
                       Paranoid sensory RAF uplink receding fluidity beef noodles numinous. Tube nano-gang Shibuya tower crypto-rebar face forwards construct. Human sentient pre-render-farm-ware pen decay tanto neural Legba smart-disposable industrial grade physical digital. 
                    </div>

                    
                </div>


            </div>
                
          </div>
    
            
        </div>





        
        @livewireScripts
    </body>
</html>
