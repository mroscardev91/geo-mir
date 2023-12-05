<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Place') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 space-y-4">

                    <!-- Mostrar las datos del place -->
                    <div class="space-y-2">
                        <p><strong>ID:</strong> {{ $place->id }}</p>
                        <p><strong>{{__('Name')}}:</strong> {{ $place->name }}</p>
                        <p><strong>{{__('Description')}}:</strong> {{ $place->description }}</p>
                    </div>

                    <!-- Formulario para actualizar un place -->
                    <form method="post" action="{{ route('places.update', $place->id) }}" enctype="multipart/form-data" class="space-y-4" id="edit-places">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="block text-gray-700">{{__('Nom')}}:</label>
                            <input type="text" name="name" value="{{ $place->name }}" required class="mt-1 p-2 w-full border rounded-md">
                        </div>
                        <div>
                            <label class="block text-gray-700">{{__('Description')}}:</label>
                            <textarea name="description" class="mt-1 p-2 w-full border rounded-md">{{ $place->description }}</textarea>
                        </div>
                        <div>
                            <label class="block text-gray-700">{{__('File')}}:</label>
                            <input type="file" name="file" class="mt-1 p-2 w-full border rounded-md">
                        </div>
                        <div id="file-error" class="text-danger"></div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{__('Actualitzar')}}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>