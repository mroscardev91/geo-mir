<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Place') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Mostra les dades del place -->
                    <p>ID: {{ $place->id }}</p>
                    <p>Name: {{ $place->name }}</p>
                    <p>Description: {{ $place->description }} bytes</p>

                    <!-- Formulari per pujar un nou place -->
                    <form method="post" action="{{ route('places.update', $place->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <label>Nom:</label>
                        <input type="text" name="name" value="{{ $place->name }}" required>
                        <label>Descripció:</label>
                        <textarea name="description">{{ $place->description }}</textarea>
                        <label>Fitxer:</label>
                        <input type="file" name="file">
                        <button type="submit">Actualitzar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>