<x-geomir-layout>

    <!-- Encabezado -->
    <div class="bg-indigo-600">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 lg:py-24">
            <div class="text-center">
                <h2 class="text-lg leading-6 font-semibold text-indigo-200 uppercase tracking-wider">
                    Bienvenidos
                </h2>
                <p class="mt-2 text-3xl font-extrabold text-white sm:text-4xl lg:text-5xl">
                    Descubre Nuestros Servicios
                </p>
                <p class="mt-3 max-w-2xl mx-auto text-xl text-indigo-200 sm:mt-5">
                    Explora lo que podemos ofrecerte.
                </p>
            </div>
        </div>
    </div>


    
    <!-- Sección de características -->
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Características</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Todo lo que necesitas
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                    Descubre todas las funcionalidades que ofrecemos.
                </p>
            </div>

            {{-- Aquí puedes agregar tarjetas de características o cualquier otro contenido --}}
        </div>
    </div>

    <!-- Pie de página -->
    <footer class="bg-gray-800">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-gray-400">
                &copy; {{ date('Y') }} Tu Compañía. Todos los derechos reservados.
            </p>
        </div>
    </footer>

 </x-geomir-layout> 