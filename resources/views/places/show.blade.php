<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Details for Place Id: ') . $place->id }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-9 bg-white border-b border-gray-200">
                    <h1>{{ $place->name }}</h1>
                    <p>{{ $place->description }}</p>
                    @if($place->file)
                        <img class="img-fluid" src="{{ asset("storage/{$place->file->filepath}") }}" alt="File Image">
                    @endif
 
                    <!-- Botó Editar -->
                    <a href="{{ route('places.edit', $place) }}" class="btn btn-primary mt-4">Editar</a>
 
                    <!-- Botó Eliminar -->
                    <form action="{{ route('places.destroy', $place) }}" method="POST" class="mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
 </x-app-layout>