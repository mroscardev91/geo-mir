<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upload Place') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
                <div class="p-8 flex items-center bg-white border-b border-gray-200">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
 
                    <form method="post" action="{{ route('places.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label>Nom:</label>
                        <input type="text" name="name" required>
                        <label>Descripció:</label>
                        <textarea name="description"></textarea>
                        <label>Fitxer:</label>
                        <input type="file" name="file">
                        <button type="submit">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
 </x-app-layout>