<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit File') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Mostra les dades del fitxer -->
                    <p>ID: {{ $file->id }}</p>
                    <p>Filepath: {{ $file->filepath }}</p>
                    <p>Filesize: {{ $file->filesize }} bytes</p>

                    <!-- Formulari per pujar un nou fitxer -->
                    <form method="post" action="{{ route('files.update', $file) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="upload">Replace File:</label>
                            <input type="file" class="form-control" name="upload"/>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('files.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>