<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\Video;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        PostResource::withoutWrapping();
        
        return Inertia::render('Home/Index', [
            'posts' => PostResource::collection(Post::latest()->take(4)->get()),
            'videos' => Video::latest()->type(1)->take(4)->get(),
        ]);
    }
}
