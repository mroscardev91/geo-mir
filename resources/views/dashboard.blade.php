@extends('layouts.geomir')
@section('header')
    <x-navigation />
@endsection

@section('content')
    <div class="bg-purple-400 flex items-center justify-center h-screen">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-gray-800 mb-8">👋{{__('Bienvenido a Nuestro Sitio')}}</h1>
            <div class="space-x-4">
                <!-- Botón Places -->
                <a href="{{ route('places.index') }}" class="px-6 py-3 bg-purple-600 text-white text-lg rounded hover:bg-purple-600 transition duration-300">
                    {{__('Places')}}
                </a>
                <!-- Botón Posts -->
                <a href="{{ route('posts.index') }}" class="px-6 py-3 bg-purple-600 text-white text-lg rounded hover:bg-purple-600 transition duration-300">
                    {{__('Posts')}}
                </a>
            </div>
        </div>
        <!-- Aquí puedes incluir más contenido HTML si lo necesitas -->
    </div>
@endsection

@section('footer')
    <!-- Pie de página -->
    <footer class="bg-gray-800 text-white">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center flex-col sm:flex-row">
                <div class="mb-6 sm:mb-0">
                    <a href="/" class="text-xl font-bold text-purple-400 hover:text-gray-300">
                        GeoApp
                    </a>
                </div>
                
                <div class="flex space-x-6">
                    <a href="#!" class="text-gray-400 hover:text-gray-300">
                        <span class="sr-only">Facebook</span>
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#!" class="text-gray-400 hover:text-gray-300">
                        <span class="sr-only">Twitter</span>
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#!" class="text-gray-400 hover:text-gray-300">
                        <span class="sr-only">Instagram</span>
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#!" class="text-gray-400 hover:text-gray-300">
                        <span class="sr-only">LinkedIn</span>
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
                
            <div class="text-center mt-8">
                <p>
                    &copy; {{ date('Y') }} GeoApp. 
                    All rights reserved.
                </p>
                <p class="mt-1">
                    Privacy Policy | Terms and Conditions
                </p>
            </div>
        </div>
    </footer>
@endsection

    
    


