@extends('layouts.geomir')
@section('header')
    @include('layouts.navigation')
    @can('create', App\Models\Place::class)
        <div class="flex justify-center bg-purple-400">
            <a href="{{ route('places.create') }}" class="text-l hover:bg-purple-600 text-black font-bold py-2 px-1 rounded">
                📍{{__('Create Place')}}
            </a>
        </div>
    @endcan
@endsection

@section('content')
 
<div class="py-12 bg-purple-400">
    <div class="flex justify-center">
        <div class="w-1/2">
            @foreach ($places as $place)
                @if($place['visibility_id'] == 1 || ($place['visibility_id'] == 3 && $place->user->is(auth()->user())) || auth()->user()->role_id == 2)
                    <div class="bg-gray-200 shadow-sm rounded-lg mb-6 border-2 border-purple-600">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-4">{{ $place->name }}</h3>
                            <p>{{ $place->description }}</p>
                            @if($place->file)
                                <div class="flex justify-center">
                                    <img class="img-fluid rounded shadow-md w-full h-64 object-cover mb-4" src="{{ asset("storage/{$place->file->filepath}") }}" alt="{{__('File Image')}}">
                                </div>
                                
                            @endif
                            
                        </div>
                        <div class="px-6 py-4 bg-purple-600 flex justify-end items-center">
                            @can('Favorite', $place)
                                <p>{{ $place->favorited_count }}</p>
                                @php
                                    $isFavorited = $place->favorited->contains('id', auth()->id());
                                @endphp
                                <form action="{{ route('places.favorite', ['place' => $place->id]) }}" method="POST" class="mr-4">
                                    @csrf
                                    <button class="text-3xl bg-transparent border-none hover:text-yellow-500 focus:outline-none">
                                        {{ $isFavorited ? '⭐️' : '✩' }}
                                    </button>
                                </form>
                            @endcan
                            <a href="{{ route('places.show', $place) }}" class="bg-blue-500 hover:bg-sky-500 text-white font-bold py-2 px-4 rounded">Show</a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

@endsection

@section('footer')
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
