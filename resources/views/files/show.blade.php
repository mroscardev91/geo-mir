<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Details for File ID: ') . $file->id }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p><strong>Filepath:</strong> {{ $file->filepath }}</p>
                    <p><strong>Filesize:</strong> {{ $file->filesize }}</p>
                    <p><strong>Created At:</strong> {{ $file->created_at }}</p>
                    <p><strong>Updated At:</strong> {{ $file->updated_at }}</p>
                    <img class="img-fluid" src="{{ asset("storage/{$file->filepath}") }}" alt="File Image">
 
                    <!-- Botó Editar -->
                    <a href="{{ route('files.edit', $file) }}" class="btn btn-primary mt-4">Editar</a>
 
                    <!-- Botó Eliminar -->
                    <form action="{{ route('files.destroy', $file) }}" method="POST" class="mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
 </x-app-layout>