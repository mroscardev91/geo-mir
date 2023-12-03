@extends('layouts.geomir')
@section('header')
    @include('layouts.navigation')
@endsection

@section('content')
    <!-- Encabezado -->
    <div class="bg-purple-600">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 lg:py-24">
            <div class="text-center">
                <h2 class="text-lg leading-6 font-semibold text-purple-200 uppercase tracking-wider">
                    Welcome to <span class="text-black">GeoApp</span>
                </h2>
                <p class="mt-2 text-3xl font-extrabold text-white sm:text-4xl lg:text-5xl">  
                    Discover Our Services
                </p>
                <!-- Imagen centrada aquí -->
                <img src="{{ asset('img/logo.png') }}" alt="Geomir Logo" class="mx-auto mt-6 w-1/2">
                <!-- Fin de la imagen -->
                <p class="mt-3 max-w-2xl mx-auto text-xl text-purple-200 sm:mt-5">
                    Explore what we can offer you.
                </p>
                <!-- Botones de llamada a la acción -->
                <div class="mt-8 flex justify-center space-x-4">
                    <a href="#services" class="px-6 py-2 border border-transparent text-base font-medium rounded-md text-purple-700 bg-white hover:bg-purple-50">
                        Our Services
                    </a>
                    <a href="#contact" class="px-6 py-2 border border-transparent text-base font-medium rounded-md text-white bg-purple-500 hover:bg-purple-400">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
    
            <!-- Sección de Características con Tarjetas -->
    <div class="py-12 bg-purple-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-purple-600 font-semibold tracking-wide uppercase">
                    Characteristics</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Everything you need
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-600 lg:mx-auto">
                    Discover all the features we offer.
                </p>
            </div>

            <!-- Tarjetas -->
            <div class="mt-10">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <!-- Tarjeta 1 -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">📍Places</h3>
                            <p class="mt-2 text-base text-gray-600">
                                You can create your own places so that people can see them and also be able to view other sites of other users. You can also modify the place and delete it
                            </p>
                        </div>
                    </div>

                    <!-- Tarjeta 2 -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">📮Posts</h3>
                            <p class="mt-2 text-base text-gray-600">
                                You can create your own posts so that people can see them and also be able to view other posts from other users. You can also modify the post and delete it
                            </p>
                        </div>
                    </div>

                    <!-- Tarjeta 3 -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">⭐Favorites and Likes</h3>
                            <p class="mt-2 text-base text-gray-600">
                                You can add places to favorites and like the posts you like the most.
                            </p>
                        </div>
                    </div>

                    <!-- Tarjeta 4 -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">💬Talk with people</h3>
                            <p class="mt-2 text-base text-gray-600">
                                You have a chat so you can talk to people on the social network
                            </p>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">🌍
                                Multilanguage system</h3>
                            <p class="mt-2 text-base text-gray-600">
                                The application has a multilingual system that will make it as easy as possible for you to use it in several languages, as you wish.
                            </p>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">👤
                                Followers</h3>
                            <p class="mt-2 text-base text-gray-600">
                                You can follow people and see their posts and places
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Sección de testimonios o reseñas -->
    <div class="bg-purple-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h3 class="text-2xl leading-9 font-extrabold text-gray-900 sm:text-3xl sm:leading-10">
                    What Our Customers Say
                </h3>
                <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-4">
                    The opinions of our clients seem very important to us and we listen to them.
                </p>
            </div>
            <!-- Carrusel de testimonios -->
            <div class="mt-12 flex justify-center">
                <div class="w-full sm:w-3/4 lg:w-1/2">
                    <!-- Testimonio 1 -->
                    <div class="mb-8">
                        <blockquote class="relative p-8 border border-purple-600 rounded-lg ">
                            <p class="text-lg text-gray-500">
                                "I've never experienced such amazing service. GeoApp really understands our needs and delivers!"
                            </p>
                            <footer class="mt-4">
                                <div class="flex items-center">
                                    <img class="w-12 h-12 rounded-full" src="{{ asset('img/client-satisfied.jpg') }}" alt="Foto del cliente">
                                    <div class="ml-4">
                                        <p class="text-base font-semibold text-gray-700">Sarah Doe, Happy Customer</p>
                                    </div>
                                </div>
                            </footer>
                        </blockquote>
                    </div>
                    <!-- Testimonio 2 -->
                    <div class="mb-8">
                        <blockquote class="relative p-8 border border-purple-600 rounded-lg">
                            <p class="text-lg text-gray-500">
                                "GeoApp's service is outstanding! They went above and beyond to meet our needs."
                            </p>
                            <footer class="mt-4">
                                <div class="flex items-center">
                                    <img class="w-12 h-12 rounded-full" src="{{ asset('img/cliente.png') }}" alt="Foto de otro cliente">
                                    <div class="ml-4">
                                        <p class="text-base font-semibold text-gray-700">John Smith, Satisfied Client</p>
                                    </div>
                                </div>
                            </footer>
                        </blockquote>
                    </div>

                    <div class="mb-8">
                        <blockquote class="relative p-8 border border-purple-600 rounded-lg">
                            <p class="text-lg text-gray-500">
                                "Working with GeoApp was a game-changer for our business. Their attention to detail and customer service is unmatched."
                            </p>
                            <footer class="mt-4">
                                <div class="flex items-center">
                                    <img class="w-12 h-12 rounded-full" src="{{ asset('img/cliente2.png') }}" alt="Foto de otro cliente">
                                    <div class="ml-4">
                                        <p class="text-base font-semibold text-gray-700">Alex Johnson, CEO of Innovate Ltd.</p>
                                    </div>
                                </div>
                            </footer>
                        </blockquote>
                    </div>
                    <!-- Agregar más testimonios según sea necesario -->
                </div>
            </div>
        </div>
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

