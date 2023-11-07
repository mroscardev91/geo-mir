<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Post;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PostRequest;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('posts.index', [
            'posts' => Post::with('user', 'file')->latest()->get(),
        ]);
    }

    /**
    * Store a newly created resource in storage.
    */
    public function store(PostRequest $request): RedirectResponse
    {
        // $request->saveImage($request);
        $file = null;
        if($request->hasFile("image" )){
           $file = $request->saveImage($request);
        }

        $request->user()->posts()->create([
            'message' => $request->input('message'),
            'file_id' => $file ? $file->id : null
        ]);

        return redirect(route('posts.index'));
    }

    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        $this->authorize('update', $post);
        $path = null;
        if($request->hasFile("image" )){
            $path = $request->saveImage($request);
            Storage::delete($post->image);
        }
        $path = $path ?: $post->image;

        app('log')->info("Request Captured", $request->all());
        $post->update(['message' => $request->input('message'), 'image' => $path]);

        return redirect(route('chirps.index'));
    }

    public function destroy(Post $post): RedirectResponse
    {
        $this->authorize('delete', $post);
        if ($post->image) {
            Storage::delete($post->image);
        }
        $post->delete();

        return redirect(route('chirps.index'));
    }
}
