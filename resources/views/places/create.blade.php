<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Place') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 space-y-4">

                    @if ($errors->any())
                    <div class="alert alert-danger space-y-2">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form method="post" action="{{ route('places.store') }}" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-gray-700">{{__('Name')}}:</label>
                            <input type="text" name="name" required class="mt-1 p-2 w-full border rounded-md">
                        </div>
                        <div>
                            <label class="block text-gray-700">{{__('Description')}}:</label>
                            <textarea name="description" class="mt-1 p-2 w-full border rounded-md"></textarea>
                        </div>
                        <div>
                            <label class="block text-gray-700">{{__('File')}}:</label>
                            <input type="file" name="file" class="mt-1 p-2 w-full border rounded-md">
                        </div>
                        <select name="visibility">
                            <option value="1">{{__('Public')}}</option>
                            <option value="2">{{__('Contacts')}}</option>
                            <option value="3">{{__('Private')}}</option>
                        </select>
                        
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{__('Guardar')}}</button>
                        <a href="{{ route('places.index') }}" class="bg-sky-500 hover:bg-sky-500 text-black font-bold py-2 px-4 rounded">{{__('Tornar a enrere')}}</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>