<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Post;
use App\Models\Like;
use App\Models\File;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Log;


class PostController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $posts = Post::with('user', 'file')->latest()->get();
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
   
            // Realizar la búsqueda en la base de datos
            foreach ($posts as $post){
                $isLiked =Like::where('user_id',auth()->user()->id)
                ->where('post_id', $post->id )
                ->first();
                if ($isLiked){
                    $post->isLiked = True;
                }else{
                    $post->isLiked = False;
                }
            };

            return view('posts.index', compact('posts'));
        } else {
            $posts = Post::withCount('liked')
            ->orderBy('id', 'desc')
            ->paginate(5);
            
            foreach ($posts as $post){
                $isLiked =Like::where('user_id',auth()->user()->id)
                ->where('post_id', $post->id )
                ->first();
                if ($isLiked){
                    $post->isLiked = True;
                }else{
                    $post->isLiked = False;
                }

            }
            return view("posts.index", [
                "posts" => $posts
            ]);
        }
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

    public function show(Post $post): View
    {

        return view('posts.show', [
            'post' => $post,
        ]);

    }

    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        app('log')->info("Request Captured", $request->all());

        $post->update(['message' => $request->input('message')]);

        if($request->hasFile("image" )){
            Storage::disk('public')->delete(explode("/", $post->file->filepath)[1]);
            $post->file->delete();

            $file = $request->saveImage($request);

            $post->update(['file_id' => $file->id]);
        }

        return redirect(route('posts.index'));
    }

    public function destroy(Post $post): RedirectResponse
    {
        if ($post['file_id'] != null){
            $post->file->delete();
            Storage::disk('public')->delete(explode("/", $post->file->filepath)[1]);
        }
        $post->delete();
        return redirect(route('posts.index'));
    }

    public function like(Request $request, Post $post)
    {
        $this->authorize('like');
        
        $like =Like::where('user_id',auth()->user()->id)
                    ->where('post_id', $post->id )
                    ->first();
        if($like){
            $like->delete();
            Log::debug("Like eliminado correctamente");
            return redirect()->route('posts.index');
           

        }else{
            $like = Like::create([
                'user_id' => auth()->user()->id,
                'post_id' => $post->id,
            ]);
            $isLiked=True;
            Log::debug("Like creado correctamente");
            return redirect()->route('posts.index');
            
        }

        dd($$post);
    }
}
