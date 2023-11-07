<?php

namespace App\Http\Controllers;

use App\Models\File;
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
    public function edit(Post $post): View
    {

        return view('posts.edit', [
            'post' => $post,
        ]);

    }
    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        app('log')->info("Request Captured", $request->all());

        $post->update(['message' => $request->input('message')]);

        if($request->hasFile("image" )){
            Storage::disk('public')->delete($post->file->filepath);
            $post->file->delete();

            $file = $request->saveImage($request);

            $post->update(['file_id' => $file->id]);
        }

        return redirect(route('posts.index'));
    }

    public function destroy(Post $post): RedirectResponse
    {
        Storage::disk('public')->delete($post);
        if($post->file->id != null){
            $post->file->delete();
        }
        $post->delete();
        return redirect(route('posts.index'));
    }
}
