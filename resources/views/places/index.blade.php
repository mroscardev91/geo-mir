<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Places') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <a href="{{ route('places.create') }}" class="bg-sky-500 hover:bg-sky-500 text-black font-bold py-2 px-4 rounded">Create Place</a>
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                       <thead class="bg-gray-50">
                           <tr>
                               <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                               <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                               <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                               <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name author</th>
                           </tr>
                       </thead>
                       <tbody class="bg-white divide-y divide-gray-200">
                           @foreach ($places as $place)
                           <tr class="hover:bg-gray-100">
                               <td class="px-6 py-4 whitespace-nowrap">{{ $place->id }}</td>
                               <td class="px-6 py-4 whitespace-nowrap">{{ $place->name }}</td>
                               <td class="px-6 py-4 whitespace-nowrap">{{ $place->description }}</td>
                               <td class="px-6 py-4 whitespace-nowrap">{{ $place->author->name }}</td>
                           </tr>
                           @endforeach
                       </tbody>
                   </table>
                </div>
            </div>
        </div>
    </div>
 </x-app-layout>