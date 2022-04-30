<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ArticleController extends Controller
{
    public function index()
    {
        return Inertia::render('Article/Index', [
            "posts" => Post::latest()->simplePaginate(12),
        ]);
    }

    public function show(Post $post)
    {
        PostResource::withoutWrapping();
        
        return Inertia::render('Article/Show', [
            "post" => new PostResource($post)
        ]);
    }
}
