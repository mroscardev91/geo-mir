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

                    <div class="mt-2 ml-20 pb-20 items-center justify-center">
                        <h1>Reviews</h1>
                        <form action="{{ route('reviews.store', $place->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <div class="mb-4">
                                <label for="body" class="block text-gray-700 text-sm font-bold mb-2">{{ __('Body') }}:</label>
                                <input type="text" class="form-input py-2 px-4 block w-full leading-5 rounded-md transition duration-150 ease-in-out sm:text-sm sm:leading-5" name="body" required/>
                                <div id=descriptionError class="text-red-500"> </div>
                            </div>
                        <button type="submit" class="bg-yellow-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                            Añadir Review
                        </button>
                    </form>
                        <hr>
                        @if ($reviews->count() > 0)
                    
                            @foreach($reviews as $index => $review)
                            <div class="bg-white mx-auto w-full sm:w-3/4 md:w-1/2 lg:w-1/2 xl:w-1/2 border border-gray-300 rounded-lg p-4  mt-6">
                                <h2>{{$review->user->name }}</h2>
                                <p>{{$review->body}}</p>
                    
                                @can('delete', $review)
                                    <form action="{{ route('reviews.destroy', $review->id)  }}" method="POST" onsubmit="return confirm('¿Estás seguro?')" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline-red active:bg-red-800">
                                        {{ __('Delete') }}
                                        </button>
                    
                                    </form>
                    
                                    @endcan
                            </div>
                            @endforeach
                    
                        @else
                        <h1>No hay comentarios aún</h1>
                        @endif
                    </div>
                    

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