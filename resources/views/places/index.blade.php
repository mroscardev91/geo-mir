<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Places') }}
            @can('create', App\Models\Place::class)
                <a href="{{ route('places.create') }}" class="text-l hover:bg-sky-500 text-black font-bold py-2 px-1 ml-2 rounded">📍{{__('Create Place')}}</a>
            @endcan
            
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                       <thead class="bg-gray-50">
                           <tr>
                               <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                               <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{__('Name')}}</th>
                               <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{__('Description')}}</th>
                               <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{__('Name Author')}}</th>
                               <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{__('Favoritos')}}</th>

                           </tr>
                       </thead>
                       <tbody class="bg-white divide-y divide-gray-200">
                           @foreach ($places as $place)
                            @if($place['visibility_id'] == 1 || ($place['visibility_id'] == 3 && $place->user->is(auth()->user())) ||auth()->user()->role_id == 2)
                                <tr class="hover:bg-gray-100">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $place->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $place->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $place->description }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $place->author->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $place->favorited_count }}</td>
                                    @can('Favorite', $place)
                                        <td class="px-6 py-4 whitespace-nowrap">@php
                                            $isFavorited = $place->favorited->contains('id', auth()->id());
                                            @endphp
                        
                                            <form action="{{ route('places.favorite', ['place' => $place->id]) }}" method="POST">
                                                @csrf
                                                <button class="text-3xl bg-transparent border-none hover:text-yellow-500 focus:outline-none mb-5">
                                                    {{ $isFavorited ? '⭐️' : '✩' }}
                                                </button>
                                            </form></td>
                                        @endcan                       
                                    <td class="px-6 py-4 whitespace-nowrap"><a href="{{ route('places.show', $place) }}" class="bg-blue-500 hover:bg-sky-500 text-black font-bold py-2 px-4 rounded">{{__('Show')}}</a></td>
                                </tr>
                            @endif
                           @endforeach
                       </tbody>
                   </table>
                </div>
            </div>
        </div>
    </div>
 </x-app-layout>