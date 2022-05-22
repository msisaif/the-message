<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Http\Resources\VideoResource;
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
            'posts' => PostResource::collection(Post::inRandomOrder()->take(4)->get()),
            'videos' => VideoResource::collection(Video::inRandomOrder()->type(1)->take(4)->get()),
        ]);
    }
}
