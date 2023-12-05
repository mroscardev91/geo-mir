
@extends('layouts.geomir')
@section('header')
    @include('layouts.navigation')
@endsection
    
@section('content')
<div class="bg-purple-400"> 
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        @can('create', App\Models\Post::class)
            <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                @csrf
                <textarea
                    name="message"
                    placeholder="{{ __('What\'s on your mind?') }}"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                >{{ old('message') }}</textarea>
                <input type="file" name="image">
                <select name="visibility">
                    <option value="1">{{__('Public')}}</option>
                    <option value="2">{{__('Contacts')}}</option>
                    <option value="3">{{__('Private')}}</option>
                </select>
                <x-input-error :messages="$errors->get('message')" class="mt-2" />
                <x-primary-button class="mt-4">{{ __('Post') }}</x-primary-button>
            </form>
        @endcan


    <div class="mt-6  shadow-sm rounded-lg divide-y ">
            @foreach ($posts as $post)
                @if($post['visibility_id'] == 1 || ($post['visibility_id'] == 3 && $post->user->is(auth()->user())) ||auth()->user()->role_id == 2)
                    <div class="p-6 flex space-x-2 bg-white border-2 border-purple-700 rounded m-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <div class="flex-1">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-gray-800">{{ $post->user->name }}</span>
                                    <small class="ml-2 text-sm text-gray-600">{{ $post->created_at->format('j M Y, g:i a') }}</small>
                                    @unless ($post->created_at->eq($post->updated_at))
                                        <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                                    @endunless
                                </div>
                                <x-dropdown>
                                    <x-slot name="trigger">
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        @can('update', $post)
                                            <x-dropdown-link :href="route('posts.edit', $post)">
                                                {{ __('Edit') }}
                                            </x-dropdown-link>
                                        @endcan
                                        @can('delete', $post)
                                        <form method="POST" action="{{ route('posts.destroy', $post) }}">
                                            @csrf
                                            @method('delete')
                                            <x-dropdown-link :href="route('posts.destroy', $post)" onclick="event.preventDefault(); this.closest('form').submit();">
                                                {{ __('Delete') }}
                                            </x-dropdown-link>
                                        </form>
                                        @endcan
                                        <x-dropdown-link :href="route('posts.show', $post)">
                                            {{ __('Show') }}
                                        </x-dropdown-link>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                            
                            <p class="mt-4 text-lg text-gray-900">{{ $post->message }}</p>
                            @if (!empty($post->file))
                                <img src="{{ asset( $post->file->filepath) }}" alt="Imagen de Post">
                            @endif
                            <br>
                            @can('like', App\Models\Post::class)
                                <form action="{{ route('posts.like', ['post' => $post->id]) }}" method="post">
                                    @csrf
                                    @method('POST')
                                        <p></p>
                                        @if($post->isLiked)
                                            <button type="submit"><a>❤️</a> {{$post->liked_count}}</button>
                                        @else
                                            <button type="submit"> <a>♡</a> {{$post->liked_count}}</button>
                                        @endif
                                </form> 
                            @endcan              
                        </div>  
                    </div>
                @endif 
            @endforeach
        </div>
    </div>
    </div>
</div>
@endsection
@section('footer')
    <!-- Pie de página -->
    <footer class="bg-gray-800 text-white">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center flex-col sm:flex-row">
                <div class="mb-6 sm:mb-0">
                    <a href="/" class="text-xl font-bold text-purple-400 hover:text-gray-300">
                        GeoApp
                    </a>
                </div>
                
                <div class="flex space-x-6">
                    <a href="#!" class="text-gray-400 hover:text-gray-300">
                        <span class="sr-only">Facebook</span>
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#!" class="text-gray-400 hover:text-gray-300">
                        <span class="sr-only">Twitter</span>
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#!" class="text-gray-400 hover:text-gray-300">
                        <span class="sr-only">Instagram</span>
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#!" class="text-gray-400 hover:text-gray-300">
                        <span class="sr-only">LinkedIn</span>
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
                
            <div class="text-center mt-8">
                <p>
                    &copy; {{ date('Y') }} GeoApp. 
                    All rights reserved.
                </p>
                <p class="mt-1">
                    Privacy Policy | Terms and Conditions
                </p>
            </div>
        </div>
    </footer>
@endsection

