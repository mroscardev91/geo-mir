<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Post;
use App\Models\Like;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PostRequest;
use Doctrine\DBAL\Schema\View;
use Illuminate\Support\Facades\Log;


class PostController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }
    
    public function index(Request $request)
    {
        $posts = Post::with('user', 'file')->latest()->get();
        return json_encode( ['data' => $posts]);
    }

    public function showLikes(Request $request, Post $post)
    {
        
    }
}
