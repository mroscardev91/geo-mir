<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Details for Place Id: ') . $place->id }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-9 bg-white border-b border-gray-200 space-y-4">
                    <h1 class="text-2xl font-bold">{{ $place->name }}</h1>
                    <p class="text-gray-700">{{ $place->description }}</p>
                    @if($place->file)
                        <img class="img-fluid rounded shadow-md" src="{{ asset("storage/{$place->file->filepath}") }}" alt="{{__('File Image')}}">
                    @endif

                    @can('Favorite', $place)
                        <p>{{__('Favoritos')}}: {{ $place->favorited_count }}</p>

                        @php
                        $isFavorited = $place->favorited->contains('id', auth()->id());
                        @endphp
                        <form action="{{ route('places.favorite', ['place' => $place->id]) }}" method="POST">
                            @csrf
                            <button class="text-3xl bg-transparent border-none hover:text-yellow-500 focus:outline-none mb-5">
                                {{ $isFavorited ? '⭐️' : '✩' }}
                            </button>
                        </form>
                    @endcan
                    

                    <!-- Botón Editar -->
                    @can('update', $place)
                        <a href="{{ route('places.edit', $place) }}" class="bg-yellow-300 hover:bg-sky-500 text-black font-bold py-2 px-4 rounded mt-6">{{__('Editar')}}</a>
                    @endcan

                    @can('delete', $place)
                        <!-- Botón Eliminar -->
                        <form action="{{ route('places.destroy', $place) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-400 hover:bg-sky-500 text-black font-bold py-2 px-4 rounded mt-2 mb-4">{{__('Eliminar')}}</button>
                        </form>
                    @endcan

                    <a href="{{ route('places.index') }}" class="bg-blue-500 hover:bg-sky-500 text-black font-bold py-2 px-4 rounded">{{__('Places')}}</a>
                </div>
            </div>
        </div>
    </div>
 </x-app-layout>