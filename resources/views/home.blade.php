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
                    Welcome to <span class="text-black">GeoMir</span>
                </h2>
                <p class="mt-2 text-3xl font-extrabold text-white sm:text-4xl lg:text-5xl">  
                    Discover Our Services
                </p>
                <p class="mt-3 max-w-2xl mx-auto text-xl text-purple-200 sm:mt-5">
                    Explore what we can offer you.
                </p>
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

                    <!-- Más tarjetas según sea necesario... -->
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>
@endsection

@section('footer')
    <!-- Pie de página -->
    <footer class="bg-gray-800">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-gray-400">
                &copy; {{ date('Y') }} Tu Compañía. Todos los derechos reservados.
            </p>
        </div>
    </footer>
@endsection

